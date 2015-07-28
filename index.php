<?php

require_once '_root_.php';
require_once _ROOT_.'/php_utils/common.php';

if (isset($_SESSION['uid']) || isset($_COOKIE['authToken'])) {
  header("Location: user.php");
  exit();
}

$formToken = md5(uniqid('auth', true));

$_SESSION['formToken'] = $formToken;

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Spell Vocabulary</title>

  <link href="http://fonts.googleapis.com/css?family=Trade+Winds" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">

  <script type="text/javascript">
    var FIRSTNAME_MIN_LEN = <?php echo $FIRSTNAME_MIN_LEN; ?>;
    var FIRSTNAME_MAX_LEN = <?php echo $FIRSTNAME_MAX_LEN; ?>;
    var LASTNAME_MIN_LEN = <?php echo $LASTNAME_MIN_LEN; ?>;
    var LASTNAME_MAX_LEN = <?php echo $LASTNAME_MAX_LEN; ?>;
    var PASSWORD_MIN_LEN = <?php echo $PASSWORD_MIN_LEN; ?>;
    var PASSWORD_MAX_LEN = <?php echo $PASSWORD_MAX_LEN; ?>;
    var EMAIL_MAX_LEN = <?php echo $EMAIL_MAX_LEN; ?>;
  </script>

  <script type="text/javascript" src="lib/jQuery/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="lib/jQuery/jquery-validate.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
</head>
<body>
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <h1 class="main-title text-center">Spell Vocabulary</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <form class="form-horizontal" id="login" action="login.php" method="post">
          <div class="form-group">
            <label for="loginEmail" class="control-label">Email address</label><br>
            <input type="email" class="form-control" name="email" placeholder="Email address"
                   maxlength="<?php echo $EMAIL_MAX_LEN; ?>">
          </div>
          <div class="form-group">
            <label for="loginPassword" class="control-label">Password</label><br>
            <input type="password" class="form-control" name="password" placeholder="Password"
                   minlength="<?php echo $PASSWORD_MIN_LEN; ?>"
                   maxlength="<?php echo $PASSWORD_MAX_LEN; ?>">
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label><input type="checkbox" name="remember">Remember me</label>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-default">Log In</button>
          </div>
        </form>
      </div>

      <div class="col-md-6">
        <h3>Registration</h3>
        <form class="form-horizontal" id="registration" action="signup.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name="firstName" placeholder="First Name"
                   minlength="<?php echo $FIRSTNAME_MIN_LEN; ?>"
                   maxlength="<?php echo $FIRSTNAME_MAX_LEN; ?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="lastName" placeholder="Last Name"
                   minlength="<?php echo $LASTNAME_MIN_LEN; ?>"
                   maxlength="<?php echo $LASTNAME_MAX_LEN; ?>">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email address"
                   maxlength="<?php echo $EMAIL_MAX_LEN; ?>">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password"
                   minlength="<?php echo $PASSWORD_MIN_LEN; ?>"
                   maxlength="<?php echo $PASSWORD_MAX_LEN; ?>">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-default">Sign Up</button>
          </div>
          <div>
            <input type="hidden" name="formToken"
                   value="<?php echo $formToken; ?>">
          </div>
        </form>
      </div>

    </div>
  </div>
</body>
</html>
