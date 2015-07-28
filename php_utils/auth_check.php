<?php

require_once '_root_.php';
require_once _ROOT_.'/php_utils/common.php';
require_once _ROOT_.'/php_utils/db_utils.php';

$allow = false;

if (isset($_SESSION['uid'])) {
  $allow = true;
} else if (isset($_COOKIE['authToken'])) {
  $token = $_COOKIE['authToken'];

  $data = dbFetchAuthDataByToken($token);
  if ($data !== null) {
    $uid = $data['uid'];
    $expires = strtotime($data['expires']);
    if (time() > $expires) {
      dbDeleteAuthDataByUID($uid);
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
  header("Location: ../index.php");
  exit();  
}

?>