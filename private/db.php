<?php
/**
 * Opens a connection to a MySQL database using the credentials supplied by the environment variables within `.env`.
 * `.env` is required to be at the root directory of the project.
 *
 * The `.env` file requires:
 *  - `DB_HOST`: Database hostname
 *  - `DB_SCHEMA`: The name of the schema to operate within
 *  - `DB_USERNAME`: The username to log in with
 *  - `DB_PASSWORD`: The password to use to log into the user with (this function assumes a user identified by a password)`
 **/
function get_mysql_db_connection() : PDO
{
  $env = parse_ini_file(dirname(__FILE__) . '../../.env');

  $host = $env['DB_HOST'];
  $schema = $env['DB_SCHEMA'];

  $user = $env['DB_USERNAME'];
  $pw = $env['DB_PASSWORD'];

  $connstring = "mysql:host=$host;dbname=$schema;charset=utf8mb4";

  return new PDO(
    $connstring,
    $user,
    $pw);
}
