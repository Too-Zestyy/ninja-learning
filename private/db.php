<?php
function get_db_connection() : PDO
{
  $env = parse_ini_file(dirname(__FILE__) . '../../.env');

  $host = $env['DB_HOST'];
  $schema = $env['DB_SCHEMA'];

  $user = $env['DB_USERNAME'];
  $pw = $env['DB_PASSWORD'];

  return new PDO(
    'mysql:host=' . $host . ';' .
    'dbname=' . $schema . ';' .
    'charset=utf8mb4',
    $user,
    $pw);
}
