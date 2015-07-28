<?php

require_once '_root_.php';
require_once _ROOT_.'/php_utils/common.php';
require_once _ROOT_.'/php_utils/db_utils.php';
require _ROOT_.'/php_utils/auth_check.php';

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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>User Page</title>

  <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">

  <script type="text/javascript" src="lib/jQuery/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="js/user.js"></script>
</head>
<body>
  <div class="container">

    <div class="row">
      <div class="col-md-8">
        <h3><?php echo "Hello $firstName $lastName!"; ?></h3>
      </div>
      <div class="col-md-4">
        <a href="logout.php">Log out</a>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <h4 class="text-center">Your books</h4>
        <div id="bookList">
          <?php require _ROOT_.'/php_async/print_book_list.php'; ?>
        </div>
      </div>
      <div class="col-md-4">
        <form class="form-horizontal" id="formUploadFile" method="post">
          <div class="form-group">
            <label>Upload book:</label>
          </div>
          <div class="form-group">
            <input type="file" name="file" required></input>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-default">Upload</button>
          </div>
        </form>
        <label id="editBooksMsg"></label>
      </div>
    </div>

  </div>
</body>
</html>