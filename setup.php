<!DOCTYPE html>
<html>
<head>
  <title>Setting up database</title>
</head>
<body>
  <h3>Setting up ...</h3>
  <?php
    require_once 'common.php';

    // Stores sha1 password hash which
    // is always 40 characters long.
    createTable('users', '
      userId INT(32) NOT NULL AUTO_INCREMENT,
      email VARCHAR(' . $EMAIL_MAX_LEN . ') NOT NULL,
      firstName VARCHAR(' . $FIRSTNAME_MAX_LEN . ') NOT NULL,
      lastName VARCHAR(' . $LASTNAME_MAX_LEN . ') NOT NULL,
      password VARCHAR(40) NOT NULL,
      PRIMARY KEY (userId),
      UNIQUE KEY (email)
    ');
  ?>
  <br>... done!
</body>
</html>