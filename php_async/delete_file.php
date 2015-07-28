<?php

require_once '_root_.php';
require_once _ROOT_.'/php_utils/common.php';
require_once _ROOT_.'/php_utils/db_utils.php';
require _ROOT_.'/php_utils/auth_check.php';

$uid = $_SESSION['uid'];
$bookID = $_POST['bookID'];
$fileName = dbFetchBookFileNameByID($bookID);
$filePath = getUserFilesDirPath($uid) . $fileName;
$message = '';

if (file_exists($filePath)) {
  if (unlink($filePath)) {
    dbDeleteBookDataByID($bookID);
    $message = "File was deleted successfully.";
  } else {
    $message = "Internal error occurred.";
  }
} else {
  $message = "File does not exist.";
}

echo $message;

?>