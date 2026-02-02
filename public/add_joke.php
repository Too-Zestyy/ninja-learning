<?php
$setup = $_POST["setup"];
$punchline = $_POST["punchline"];

// Both entries filled
if ($setup && $punchline) {
  $message = 'Joke submitted';

  try {
    include "../private/db.php";
    $q = '';
    $pdo = get_mysql_db_connection();

    $stmt = $pdo->prepare('INSERT INTO jokes (setup, punchline) VALUES (:setup, :punchline);');
    $stmt->bindParam(':setup', $setup);
    $stmt->bindParam(':punchline', $punchline);

    $stmt->execute();

    $message = 'Joke added to DB.';

  }
  catch (PDOException $e) {
    $err = 'Unable to connect to the database server: ' . $e->getMessage();
    include '../templates/error.html.php';
  }
  catch (Exception $e) {
    $err = $e->getMessage();
    include '../templates/error.html.php';
  }
}
else {
  $message = 'Joke not submitted';
}
include '../templates/add_joke.html.php';
