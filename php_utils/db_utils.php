<?php

$dbhost = 'localhost';
$dbname = 'spellvocabulary';
$dbuser = 'spellvocabulary';
$dbpass = 'setparam1';

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error) {
  die($connection->connect_error);
}

// Common MySQL utilities: {{{

function mysqlQuery($query) {
  global $connection;
  $result = $connection->query($query);
  if (!$result) {
    die($connection->error);
  }
  return $result;
}

function mysqlFetchRow($query) {
  $result = mysqlQuery($query);
  if ($result->num_rows !== 0) {
    return $result->fetch_array(MYSQLI_ASSOC);
  }
  return null;
}

function mysqlFetchTable($query) {
  $result = mysqlQuery($query);
  $table = array();
  for ($i = 0; $i < $result->num_rows; $i++) {
    $table[] = $result->fetch_array(MYSQLI_ASSOC);
  }
  return $table;
}

function mysqlCreateTable($name, $columns) {
  mysqlQuery("CREATE TABLE IF NOT EXISTS $name($columns)");
  echo "Table '$name' created or already exists. <br>";
}

// }}}

// Table 'users': {{{

function dbFetchUserDataByEmail($email) {
  return mysqlFetchRow("SELECT * FROM users WHERE email='$email'");
}

function dbFetchUserDataByID($uid) {
  return mysqlFetchRow("SELECT * FROM users WHERE id='$uid'");
}

function dbInsertUserData($email, $firstName, $lastName, $password) {
  mysqlQuery("INSERT INTO users VALUES" .
      "(NULL, '$email', '$firstName', '$lastName', '$password')");
}

function dbFetchUserIDByEmailPass($email, $password) {
  $row = mysqlFetchRow("SELECT id FROM users WHERE email='$email' AND password='$password'");
  return $row !== null ? $row['id'] : null;
}

// }}}

// Table 'auth_tokens': {{{

function dbFetchAuthDataByToken($token) {
  return mysqlFetchRow("SELECT * FROM auth_tokens WHERE token='$token'");
}

function dbInsertAuthData($token, $uid, $expires) {
  mysqlQuery("INSERT INTO auth_tokens VALUES (NULL, '$token', '$uid', '$expires')");
}

function dbDeleteAuthDataByUID($uid) {
  mysqlQuery("DELETE FROM auth_tokens WHERE uid='$uid'");
}

// }}}

/// Table 'books': {{{

function dbInsertBookData($fileName, $fileSize, $uid) {
  mysqlQuery("INSERT INTO books VALUES(NULL, '$fileName','$fileSize', '$uid')");
}

function dbFetchAllBooksDataByUID($uid) {
  return mysqlFetchTable("SELECT * FROM books WHERE uid='$uid'");
}

function dbFetchBookFileNameByID($id) {
  $row = mysqlFetchRow("SELECT fileName FROM books WHERE id='$id'"); 
  return $row !== null ? $row['fileName'] : null;
}

function dbDeleteBookDataByID($id) {
  mysqlQuery("DELETE FROM books WHERE id='$id'");
}

///}}}

?>