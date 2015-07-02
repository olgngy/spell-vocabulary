<?php

require_once 'common.php';
require 'auth_check.php';

$uid = $_SESSION['uid'];
$greetings = "";

$result = queryMysql("SELECT * FROM users WHERE id='$uid'");
if ($result->num_rows === 1) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $firstName = $row['firstName'];
  $lastName = $row['lastName'];
  echo "Hello $firstName $lastName!";
} else {
  die("Internal error");
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>User Page</title>
</head>
<body>
  <h2><?php echo $greetings; ?></h2>
  <a href="logout.php">Logout</a>
</body>
</html>