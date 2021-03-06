<?php
  require_once '_root_.php';
  require_once _ROOT_.'/php_utils/common.php';
  require_once _ROOT_.'/php_utils/db_utils.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Setting up database</title>
</head>
<body>
  <h3>Setting up ...</h3>
  <?php
    // Stores sha1 password hash which
    // is always 40 characters long.
    mysqlCreateTable('users', '
      id INT(32) NOT NULL AUTO_INCREMENT,
      email VARCHAR(' . $EMAIL_MAX_LEN . ') NOT NULL,
      firstName VARCHAR(' . $FIRSTNAME_MAX_LEN . ') NOT NULL,
      lastName VARCHAR(' . $LASTNAME_MAX_LEN . ') NOT NULL,
      password CHAR(40) NOT NULL,
      PRIMARY KEY (id),
      UNIQUE KEY (email)
    ');

    mysqlCreateTable('auth_tokens', '
      id INT(32) NOT NULL AUTO_INCREMENT,
      token CHAR(' . $AUTH_TOKEN_LEN . '),
      uid INT(32),
      expires TIMESTAMP,
      PRIMARY KEY (id),
      FOREIGN KEY (uid) REFERENCES users(id)
    ');

    mysqlCreateTable('books', '
      id INT(32) NOT NULL AUTO_INCREMENT,
      fileName VARCHAR(255) NOT NULL,
      fileSize INT(32) NOT NULL,
      uid INT(32),
      PRIMARY KEY (id),
      FOREIGN KEY (uid) REFERENCES users(id)
    ');
  ?> 
  <br>... done!
</body>
</html>