<?php

require_once 'common.php';

if (!isset($_POST['email']) ||
    !isset($_POST['password'])) {
  die('Internal error :(');
}

$email = sanitizeString($_POST['email']);
$password = sanitizeString($_POST['password']);

$result = queryMysql("SELECT * FROM users WHERE email='$email' AND password='$password'");

if ($result->num_rows) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $firstName = $row['firstName'];
  $lastName = $row['lastName'];
  echo "Hello, $firstName $lastName!";
} else {
  echo 'Invalid email/password';
}

?>