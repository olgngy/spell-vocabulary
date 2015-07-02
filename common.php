<?php

session_start();

$dbhost = 'localhost';
$dbname = 'spellvocabulary';
$dbuser = 'spellvocabulary';
$dbpass = 'setparam1';

$FIRSTNAME_MIN_LEN = 1;
$FIRSTNAME_MAX_LEN = 40;
$LASTNAME_MIN_LEN = 1;
$LASTNAME_MAX_LEN = 40;
$PASSWORD_MIN_LEN = 5;
$PASSWORD_MAX_LEN = 40;
$EMAIL_MAX_LEN = 40;
$AUTH_TOKEN_LEN = 32;

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error) {
  die($connection->connect_error);
}

function createTable($name, $columns) {
  queryMysql("CREATE TABLE IF NOT EXISTS $name($columns)");
  echo "Table '$name' created or already exists. <br>";
}

function queryMysql($query) {
  global $connection;
  $result = $connection->query($query);
  if (!$result) {
    die($connection->error);
  }
  return $result;
}

function sanitizeString($str) {
  return filter_var($str, FILTER_SANITIZE_STRING);
}

function generateAuthToken() {
  global $AUTH_TOKEN_LEN;
  return substr(str_shuffle(
    '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),
    0, $AUTH_TOKEN_LEN
  );
}

?>