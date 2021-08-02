<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
</head>
<body>
<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['submit'])) {

        $username = ($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);


        $password = ($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);


        $sql = "SELECT * from `login` where (username = '$username'); ";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) > 0){
          $message = "Username Already exits.";
          echo "<div class='form'>
                <h3>Username Already exits.</h3><br/>";
        }
        else{
        $query    = "INSERT into `login` (username, password)
                     VALUES ('$username', '" . md5($password) . "')";
        $result   = mysqli_query($con, $query);

        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
                  </div>";
        }
    }}
?>
</body>
</html>
