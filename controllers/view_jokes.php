<?php
$app->group('/api', function () use ($app, $pdo) {
    app->get('/jokes', function (Request $request, Response $response, $args) use ($pdo) {
        $query = '
        SELECT id, setup FROM jokes;
        ';
        $stmt = $pdo->query($query);

        $jokes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $response->withJson($jokes);
    });
});
