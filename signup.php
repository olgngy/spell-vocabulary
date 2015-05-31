<?php

require_once 'common.php';

if (!isset($_POST['firstName']) ||
    !isset($_POST['lastName']) ||
    !isset($_POST['email']) ||
    !isset($_POST['password'])) {
  die('Internal error :(');
}

$origFirstName = $_POST['firstName'];
$origLastName = $_POST['lastName'];
$origEmail = $_POST['email'];
$origPassword = $_POST['password'];

$firstName = sanitizeString($origFirstName);
$lastName = sanitizeString($origLastName);
$email = sanitizeString($origEmail);
$password = sanitizeString($origPassword);

$correct = true;
if ($firstName == "" || $firstName != $origFirstName) {
  echo '- Invalid first name.<br>';
  $correct = false;
}
if ($lastName == "" || $lastName != $origLastName) {
  echo '- Invalid last name.<br>';
  $correct = false;
}
if ($email == "" || $email != $origEmail) {
  echo '- Invalid email.<br>';
  $correct = false;
}
if ($password == "" || $password != $origPassword) {
  echo '- Invalid password.<br>';
  $correct = false;
}

if ($correct) {
  $result = queryMysql("SELECT * FROM users WHERE email='$email'");
  if ($result->num_rows) {
    echo '- That username already exists.<br>';
    $correct = false;
  }
}

if ($correct) {
  queryMysql("INSERT INTO users VALUES('$email', '$firstName', '$lastName', '$password')");
  echo '<h4>Account created</h4>';
} else {
  echo 'Please fix above errors to continue.';
}

?>