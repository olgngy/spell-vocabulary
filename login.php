<?php

require_once 'common.php';
require_once 'db_utils.php';

if (isset($_SESSION['uid']) || isset($_COOKIE['authToken'])) {
  header("Location: user.php");
  exit();
}

$message = "";

if (!isset($_POST['email'], $_POST['password'])) {
  $message = 'Please enter a valid username and password';
} else if (strlen($_POST['email']) > $EMAIL_MAX_LEN) {
  $message = 'Incorrect length for email';
} else if (strlen($_POST['password']) > $PASSWORD_MAX_LEN ||
           strlen($_POST['password']) < $PASSWORD_MIN_LEN) {
  $message = 'Incorrect length for password';
} else if (ctype_alnum($_POST['password']) !== true) {
  $message = "Password must be alpha numeric";
} else {
  $email = sanitizeString($_POST['email']);
  $password = sha1(sanitizeString($_POST['password']));

  $uid = dbFetchUserIDByEmailPass($email, $password);
  if ($uid !== null) {
    if ($_POST['remember']) {
      $token = generateAuthToken();

      dbDeleteAuthDataByUID($uid);

      // Remember for 1 day.
      $expires = time() + 60*60*24;
      $expiresStr = date("Y-m-d H:i:s", $expires);

      dbInsertAuthData($token, $uid, $expiresStr);

      setcookie('authToken', $token, $expires);
    }
    $_SESSION['uid'] = $uid;
    header("Location: user.php");
    exit();
  } else {
    $message = 'Login Failed';
  }  
}

echo $message;

?>