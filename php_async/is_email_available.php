<?php

require_once '_root_.php';
require_once _ROOT_.'/php_utils/common.php';
require_once _ROOT_.'/php_utils/db_utils.php';

if (isset($_POST['email'])) {
  $email = sanitizeString($_POST['email']);
 
  if (dbFetchUserDataByEmail($email) === null) {
    echo "true";
    exit();
  } 
}

echo "false";

?>