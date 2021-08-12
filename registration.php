<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="style/css_reg.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  </head>
  <body>
    <h1
      style="color: #EEEEEE;
      font-family: 'Roboto', sans-serif;
      padding: 10px;
      text-align: center;
      font-size: 50px"> Vote  and  Poll  System </h1>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link">Already have account? Click here to<a href="login.php"> Login</a></p>
    </form>

    <?php
      if(isset($_REQUEST['username'])){
        require("process_form_registration.php");
      }
     ?>
  </body>
</html>
