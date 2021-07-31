<?php
  require('db.php');
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM `polls` WHERE (id = '$id')";
    $res = mysqli_query($con, $query);

    $poll = mysqli_fetch_assoc($res);

    if($poll){
      $query = "SELECT * FROM `poll_answers` WHERE (poll_id = '$id') ORDER BY votes DESC";
      $res = mysqli_query($con, $query);

      $poll_answers = mysqli_fetch_all($res, MYSQLI_ASSOC);

      $total_votes = 0;

      foreach($poll_answers as $poll_answer){
        $total_votes += $poll_answer['votes'];
      }
    }else{
      exit('Poll with that ID does not exist.');
    }
  } else{
      exit('No poll ID specified.');
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h2><?= $poll['title'] ?></h2>
    <p><?= $poll['discription']?></p>
    <div class="">
      <?php foreach($poll_answers as $poll_answer):?>
        <p><?= $poll_answer['title']?> <span>(<?=$poll_answer['votes']?>)</span></p>
        <div class="">
          <?= $poll_answer['votes']?>
        </div>
    </div>
  <?php endforeach; ?>
  </body>
</html>
