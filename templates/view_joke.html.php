<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Script Output</title>
</head>
<body>
    <h1>Joke book: Page <?php echo $_GET['id'] ?></h1>
    <p><?php echo $setup; ?></p>
    <button id="show-punchline" onclick="
    document.getElementById('punchline').style.display = '';
    document.getElementById('show-punchline').style.display = 'none';
    ">Show the punchline!</button>
    <h1 id="punchline" style="display: none"><?php echo $punchline; ?></h1>
</body>
</html>
