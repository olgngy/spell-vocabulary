<?php

require_once 'common.php';
require_once 'db_utils.php';

if (isset($_POST['email'])) {
  $email = sanitizeString($_POST['email']);
 
  if (dbFetchUserDataByEmail($email) === null) {
    echo "true";
    exit();
  } 
}

echo "false";

?>