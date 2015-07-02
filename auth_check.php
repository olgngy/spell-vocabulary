<?php

require_once 'common.php';

$allow = false;

if (isset($_SESSION['uid'])) {
  $allow = true;
} else if (isset($_COOKIE['authToken'])) {
  $token = $_COOKIE['authToken'];

  $result = queryMysql("SELECT * FROM auth_tokens WHERE token='$token'");
  if ($result->num_rows !== 0) {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $uid = $row['uid'];
    $expires = strtotime($row['expires']);

    if (time() > $expires) {
      queryMysql("DELETE FROM auth_tokens WHERE uid='$uid'");
      setcookie('authToken', '', time() - 60*60);
    } else {
      // Allow user enter the page.
      $_SESSION['uid'] = $uid;

      $allow = true;
    }
  } else {
    setcookie('authToken', '', time() - 60*60);
  }

}

if (!$allow) {
  header("Location: index.php");
  exit();  
}

?>