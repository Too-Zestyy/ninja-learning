<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add a joke</title>
</head>
<body>
  <form action="../public/add_joke.php" method="post">
    <div>
      <label for="setup">Set-up:</label>
      <input name="setup" id="setup" type="text"/>
    </div>
    <div>
      <label for="punchline">Punchline:</label>
      <input name="punchline" id="punchline" type="text"/>
    </div>

    <input type="submit" value="Add my joke!">

  </form>
    <p><?php echo $message; ?></p>
</body>
</html>
