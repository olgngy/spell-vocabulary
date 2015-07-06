<?php

require_once 'common.php';
require_once 'db_utils.php';

if (isset($_SESSION['uid'])) {
  $uid = $_SESSION['uid'];

  session_unset();
  session_destroy();

  setcookie('authToken', '', time() - 60*60);

  dbDeleteAuthDataByUID($uid);
}

header("Location: index.php");

?>