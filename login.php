<?php

require_once 'common.php';

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

  $result = queryMysql("SELECT * FROM users WHERE " .
    "email='$email' AND password='$password'");
  if ($result->num_rows === 0) {
    $message = 'Login Failed';
  } else {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $uid = $row['id'];
    if ($_POST['remember']) {
      $token = generateAuthToken();

      queryMysql("DELETE FROM auth_tokens WHERE uid='$uid'");

      // Remember for 1 day.
      $expires = time() + 60*60*24;
      $expiresStr = date("Y-m-d H:i:s", $expires);

      queryMysql("INSERT INTO auth_tokens VALUES" .
        "(NULL, '$token', $uid, '$expiresStr')");

      setcookie('authToken', $token, $expires);
    }
    $_SESSION['uid'] = $uid;
    header("Location: user.php");
    exit();
  }
}

echo $message;

?>