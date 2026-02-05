<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\TwigMiddleware;
use Slim\Views\Twig;

require '../vendor/autoload.php';
require '../private/db.php';
require '../private/setup.php';
require '../middleware/ApiCorsHeaderMiddleware.php';

require '../services/get_jokes.php';
use Slim\Routing\RouteCollectorProxy;

$app = AppFactory::create();


// Create Twig
$twig = Twig::create('../templates', ['cache' => '../twig_cache']);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

$pdo = get_mysql_db_connection();

//$routeFiles = (array) glob(__DIR__ . '..' . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . '*.php');
//foreach($routeFiles as $routeFile) {
//    require_once $routeFile;
//    echo $routeFile;
//}

$app->get('/', function (Request $request, Response $response, $args) use ($pdo) {
    $view = Twig::fromRequest($request);

    $query = '
    SELECT id, setup FROM jokes;
    ';
    $stmt = $pdo->query($query);

    $jokes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $view->render($response, 'joke_list.html.twig', [
        'jokes' => $jokes
    ]);
});

$app->get('/jokes/{id:[0-9]+}', function (Request $request, Response $response, $args) use ($pdo) {
    $view = Twig::fromRequest($request);

    $joke_id = $args['id'];

    $joke_details_query = $pdo->prepare("SELECT setup, punchline FROM jokes WHERE id = :id");
    $joke_details_query->bindParam(':id', $joke_id);
    $joke_details_query->execute();

    $joke_details = $joke_details_query->fetch(PDO::FETCH_ASSOC);

    $setup = $joke_details['setup'];
    $punchline = $joke_details['punchline'];

    return $view->render($response, 'view_joke.html.twig', [
        'id' => $joke_id,
        'setup' => $setup,
        'punchline' => $punchline
    ]);
})->setName('viewJoke');

$app->get('/add_joke', function (Request $request, Response $response, $args) use ($pdo) {
    $view = Twig::fromRequest($request);

    return $view->render($response, 'add_joke.html.twig');
});

$app->post('/add_joke', function (Request $request, Response $response, $args) use ($pdo) {
    $view = Twig::fromRequest($request);

    $formVals = $request->getParsedBody();
    foreach($formVals as $key => $param){
        //POST or PUT parameters list
        if ($key == 'setup' && $param) {
            $setup = $param;
        }
        else if ($key == 'punchline' && $param) {
            $punchline = $param;
        }
    }

    if (!(isset($setup) && isset($punchline))) {
        return $view->render($response, 'error.html.twig', [
            'err' => 'You missed a part of the joke. We need both to add it to the book!'
        ]);
    }

    $stmt = $pdo->prepare('INSERT INTO jokes (setup, punchline) VALUES (:setup, :punchline);');
    $stmt->bindParam(':setup', $setup);
    $stmt->bindParam(':punchline', $punchline);

    $stmt->execute();

    return $view->render($response, 'view_joke.html.twig', [
        'id' => 1,
        'setup' => 'form posted',
        'punchline' => 'form posted'
    ]);
});

//$apiMiddleware = function (Request $request, \Psr\Http\Server\RequestHandlerInterface $handler) {
//    // Proceed with the next middleware
//    $response = $handler->handle($request);
//
//    // Modify the response after the application has processed the request
//    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
//
//    return $response;
//};

$app->group('/api', function (RouteCollectorProxy $group) use ($app, $pdo) {

    $group->get('/jokes[/{page:[0-9]+}]', function (Request $request, Response $response, $args) use ($pdo) {

        if (array_key_exists('page', $args)) {
            $requested_page = $args['page'];
        }
        else {
            $requested_page = 1;
        }

        $pages = get_joke_page_count($pdo);

        if ($pages < $requested_page || $requested_page == 0) {
            return $response->withStatus(400)->withJson(['error' => 'page out of range']);
        }

        return $response->withJson(
            [
                'jokes' => get_joke_page($pdo, $requested_page),
                'pages' => $pages
            ]
        );
    });
})->add(new \middleware\ApiCorsHeaderMiddleware());

$errorMiddleware = $app->addErrorMiddleware(false, true, true);

set_up_db_schema($pdo);

$app->run();