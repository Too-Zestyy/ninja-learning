<?php
declare(strict_types=1);

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

include '../private/db.php';
require_once '../vendor/autoload.php';
//Twig_Autoloader::register();
try {
  $pdo = get_mysql_db_connection();

  $id = $_GET['id'];


  // Querying a specific joke
  if ($_GET['id']) {
    $joke_details_query = $pdo->prepare("SELECT setup, punchline FROM jokes WHERE id = :id");
    $joke_details_query->bindParam(':id', $id);
    $joke_details_query->execute();

    $joke_details = $joke_details_query->fetch(PDO::FETCH_ASSOC);

    $setup = $joke_details['setup'];
    $punchline = $joke_details['punchline'];

    include '../templates/view_joke.html.php';
  }
  // Requesting the list of jokes
  else {
    $query = '
    SELECT id, setup FROM jokes;
    ';
    $stmt = $pdo->query($query);

    $jokes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $output = '';

    if ($jokes) {
      foreach ($jokes as $joke) {
        $output .= '<li><a href="./db_access.php?id='. $joke['id'] . '">' . $joke['setup'] . '<a/></li>';
      }
    }
    else {
      $output = '<p>No jokes found.</p>';
    }
    if ($_GET['id']) {
      $output .= '<p>Selected note ' . $_GET['id'] . '</p>';
    }
    $loader = new FilesystemLoader('../templates');
    $twig = new Environment($loader, [
      'cache' => '../twig_cache',
    ]);
    echo $twig->render('twig_test.twig', ['jokes' => $jokes]);
//    include '../templates/twig_test.html.twig';
  }
}
catch (PDOException $e) {
  $err = 'Unable to connect to the database server: ' . $e->getMessage();
  include '../templates/error.html.php';
}
