<?php

require_once '_root_.php';
require_once _ROOT_.'/php_utils/common.php';
require_once _ROOT_.'/php_utils/db_utils.php';
require _ROOT_.'/php_utils/auth_check.php';

$uid = $_SESSION['uid'];
$fileName = $_FILES['file']['name'];
$fileSize = $_FILES['file']['size'];
$fileDir = getUserFilesDirPath($uid);
$filePath = $fileDir . basename($fileName);
$message = '';

if (!file_exists($fileDir)) {
  mkdir($fileDir, 0777, true);
}

if (file_exists($filePath)) {
  $message = "File already exsists.";
} else {
  if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
    dbInsertBookData($fileName, $fileSize, $uid);
    $message = "File was added successfully.";
  } else {
    $message = "Internal error occurred.";
  }
}

echo $message;

?>