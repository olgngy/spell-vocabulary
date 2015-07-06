<?php

require_once 'common.php';
require_once 'db_utils.php';
require 'auth_check.php';

$uid = $_SESSION['uid'];
$data = dbFetchUserDataByID($uid);
if ($data === null) {
  die('Internal error');
}

$firstName = $data['firstName'];
$lastName = $data['lastName'];

?>
<!DOCTYPE html>
<html>
<head>
  <title>User Page</title>
</head>
<body>
  <h3><?php echo "Hello $firstName $lastName!"; ?></h3>
  <a href="logout.php">Logout</a>
</body>
</html>