<?php

require_once 'common.php';

if (!isset($_SESSION['email'])) {
  header("Location: index.php");
  exit();
}

$email = $_SESSION['email'];
$greetings = "";

$result = queryMysql("SELECT * FROM users WHERE email='$email'");
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