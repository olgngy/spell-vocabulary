<?php

  $dbhost = 'localhost';
  $dbname = 'spellvocabulary';
  $dbuser = 'spellvocabulary';
  $dbpass = 'setparam1';

  $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($connection->connect_error) {
    die ($connection->connect_error);
  }

  function createTable($name, $columns) {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($columns)");
    echo "Table '$name' created or already exists. <br>";
  }

  function queryMysql($query) {
    global $connection;
    $result = $connection->query($query);
    if (!$result) {
      die ($connection->error);
    }
    return $result;
  }
  
  function sanitizeString($str) {
    global $connection;
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);
    return $connection->real_escape_string($str);
  }

?>