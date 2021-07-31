<?php
  require('db.php');

  if(isset($_REQUEST['upload'])){
    $image = $_FILES['photo']['name'];
    $tempname = $_FILES['photo']['tmp_name'];
    $folder = "uploads/".$image;

    $query = "INSERT INTO `polls` (photo) VALUES ('$image')" ;
    mysqli_query($con, $query);

    move_uploaded_file($tempname, $folder);
?>
<?php

    $result = mysqli_query($con, "SELECT * FROM `polls`");

    while($data = mysqli_fetch_array($result)){
      ?>
      <img src = "uploads/<?php echo $data['photo']; ?>" heigth="200" width="200">
     <?php } } ?>
