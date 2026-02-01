<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Random Number</title>
</head>
<body>
<p>Rolling D6:
  <?php
  include 'd6.php';
  $d = new d6();
  $roll = $d->roll();

  if ($roll != 6) {
    echo 'You rolled a ' . $roll . '. <i>Unlucky...</i>';
  }
  else {
    echo 'Natural 6! Lucky day, today?';
  }
  ?>
</p>
</body>
</html>
