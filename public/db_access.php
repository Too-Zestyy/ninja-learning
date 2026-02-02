<?php
declare(strict_types=1);
include '../private/db.php';
try {
  $pdo = get_db_connection();

  $id = $_GET['id'];


  // Querying a specific joke
  if ($_GET['id']) {
    $joke_details_query = $pdo->prepare("SELECT * FROM jokes WHERE id = :id");
    $joke_details_query->bindParam(':id', $id);
    $joke_details_query->execute();

    $joke_details = $joke_details_query->fetch(PDO::FETCH_ASSOC);

    $output = '<p>Selected note ' . $_GET['id'] . '</p>' . '<p>' . $joke_details['punchline'] . '</p>';
    include  '../templates/db_access.html.php';
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
    include '../templates/joke_list.html.php';
  }
}
catch (PDOException $e) {
  $err = 'Unable to connect to the database server: ' . $e->getMessage();
  include '../templates/error.html.php';
}
