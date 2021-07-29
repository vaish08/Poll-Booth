<?php
  include ("auth_session.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="">
      <p>
        Hey, <?php echo $_SESSION["username"] ?> !
      </p>
      <p>You have logged in successfully.</p>
      <p><a href="logout.php">Logout</a></p>
    </div>

  </body>
</html>
