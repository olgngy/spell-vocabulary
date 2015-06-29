<?php

require_once 'common.php';

if (isset($_POST['email'])) {
  $email = sanitizeString($_POST['email']);
  
  $result = queryMysql("SELECT email FROM users WHERE email='$email'");
  if ($result->num_rows === 0) {
    echo "true";
    exit();
  } 
}

echo "false";

?>