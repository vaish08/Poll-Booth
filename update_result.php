<?php
  require('db.php');
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "INSERT INTO `result` (poll_id) VALUES ('$id')";
    mysqli_query($con, $query);
    echo
    "<script>
      alert('Poll ended successfully !!!');
      window.location.href='poll_index_admin.php';
    </script>";
    // header("Location: poll_index_admin.php");
  }
?>
