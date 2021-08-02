<?php
  date_default_timezone_set('Asia/Kolkata');
  session_start();
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
  }
?>
