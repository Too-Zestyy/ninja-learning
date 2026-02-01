<?php

$output = '';
for ($count = 1; $count <= 10; $count++) {
  $output .= $count . ' ';
}
include '../templates/count.html.php';
