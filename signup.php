<?php

require_once '_root_.php';
require_once _ROOT_.'/php_utils/common.php';
require_once _ROOT_.'/php_utils/db_utils.php';

$message = "";

if (!isset($_POST['firstName'], $_POST['lastName'],
           $_POST['email'], $_POST['password'], $_POST['formToken'])) {
  $message = 'Please enter a valid username and password';
} else if ($_POST['formToken'] !== $_SESSION['formToken']) {
  $message = 'Invalid form submission';
} else if (strlen($_POST['email']) > $EMAIL_MAX_LEN) {
  $message = 'Incorrect length for email';
} else if (strlen($_POST['password']) > $PASSWORD_MAX_LEN ||
           strlen($_POST['password']) < $PASSWORD_MIN_LEN) {
  $message = 'Incorrect length for password';
} else if (strlen($_POST['firstName']) > $FIRSTNAME_MAX_LEN ||
           strlen($_POST['firstName']) < $FIRSTNAME_MIN_LEN) {
  $message = 'Incorrect length for first name';
} else if (strlen($_POST['lastName']) > $LASTNAME_MAX_LEN ||
           strlen($_POST['lastName']) < $LASTNAME_MIN_LEN) {
  $message = 'Incorrect length for last name';
} else if (ctype_alpha($_POST['firstName']) !== true) {
  $message = "First name must be alphabetic";
} else if (ctype_alpha($_POST['lastName']) !== true) {
  $message = "Last name must be alphabetic";
} else if (ctype_alnum($_POST['password']) !== true) {
  $message = "Password must be alphanumeric";
} else {
  $firstName = sanitizeString($_POST['firstName']);
  $lastName = sanitizeString($_POST['lastName']);
  $email = sanitizeString($_POST['email']);
  $password = sha1(sanitizeString($_POST['password']));

  if (dbFetchUserDataByEmail($email) !== null) {
    $message = 'Email already exists';
  } else {
    dbInsertUserData($email, $firstName, $lastName, $password);
    $message = 'New user added';
    unset($_SESSION['formToken']);
  }
}

echo $message;

?>