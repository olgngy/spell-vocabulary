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

function mysqlCreateTable($name, $columns) {
  mysqlQuery("CREATE TABLE IF NOT EXISTS $name($columns)");
  echo "Table '$name' created or already exists. <br>";
}

// }}}

// Table 'users': {{{

function dbFetchUserDataByEmail($email) {
  $row = mysqlFetchRow("SELECT * FROM users WHERE email='$email'");
  if ($row !== null) {
    return array(
      'id' => $row['id'],
      'email' => $row['email'],
      'firstName' => $row['firstName'],
      'lastName' => $row['lastName'],
      'password' => $row['password']
    );
  }
  return null;
}

function dbFetchUserDataByID($uid) {
  $row = mysqlFetchRow("SELECT * FROM users WHERE id='$uid'");
  if ($row !== null) {
    return array(
      'id' => $row['id'],
      'email' => $row['email'],
      'firstName' => $row['firstName'],
      'lastName' => $row['lastName'],
      'password' => $row['password']
    );
  }
  return null;
}

function dbInsertUserData($email, $firstName, $lastName, $password) {
  mysqlQuery("INSERT INTO users VALUES" .
      "(NULL, '$email', '$firstName', '$lastName', '$password')");
}

function dbFetchUserIDByEmailPass($email, $password) {
  $row = mysqlFetchRow("SELECT id FROM users WHERE email='$email' AND password='$password'");
  if ($row !== null) {
    return $row['id'];
  }
  return null;
}

// }}}

// Table 'auth_tokens': {{{

function dbFetchAuthDataByToken($token) {
  $row = mysqlFetchRow("SELECT * FROM auth_tokens WHERE token='$token'");
  if ($row !== null) {
    return array(
      'id' => $row['id'],
      'token' => $row['token'],
      'uid' => $row['uid'],
      'expires' => $row['expires']
    );
  }
  return null;
}

function dbInsertAuthData($token, $uid, $expires) {
  mysqlQuery("INSERT INTO auth_tokens VALUES (NULL, '$token', '$uid', '$expires')");
}

function dbDeleteAuthDataByUID($uid) {
  mysqlQuery("DELETE FROM auth_tokens WHERE uid='$uid'");
}

// }}}

?>