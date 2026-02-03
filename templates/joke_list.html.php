<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Script Output</title>
</head>
<body>
<h1>Joke book: All Pages</h1>
<ul>
  <?php foreach ($jokes as $joke): {
    echo '<li><a href="?id=' . $joke['id'] . '">' . $joke['setup'] . '</a></li>';
  } endforeach;?>
</ul>
</body>
</html>
