<?php

require_once 'common.php';

if (isset($_SESSION['uid'])) {
  $uid = $_SESSION['uid'];

  session_unset();
  session_destroy();

  setcookie('authToken', '', time() - 60*60);

  queryMysql("DELETE FROM auth_tokens WHERE uid='$uid'");
}

header("Location: index.php");

?>