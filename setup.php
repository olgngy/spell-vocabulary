<!DOCTYPE html>
<html>
  <head>
    <title>Setting up database</title>
  </head>
  <body>
    <h3>Setting up ...</h3>
    <?php
      require_once 'common.php';

      createTable('users', '
        email VARCHAR(16),
        firstName VARCHAR(16),
        lastName VARCHAR(16),
        password VARCHAR(16),
        INDEX(email(6))
      ');
    ?>
    <br>... done!
  </body>
</html>
