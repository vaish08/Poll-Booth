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
    <title>Result</title>
    <link rel="stylesheet" href="style/css_poll.css">
  </head>
  <body>
    <nav class="navtop">
      <div>
        <h1>Voting and Poll System.</h1>
      </div>
    </nav>
    <div class="content poll-result">
      <h2><?= $poll['title'] ?></h2>
      <p><?= $poll['discription']?></p>
      <img src = "uploads/<?php echo $poll['photo']; ?>" heigth="200" width="200">
      <div class="wrapper">
        <?php foreach($poll_answers as $poll_answer):?>
          <div class="poll-question">
            <p><?= $poll_answer['title']?> <span>(<?=$poll_answer['votes']?> Votes)</span></p>
            <div class="result-bar" style= "width:<?=@round(($poll_answer['votes']/$total_votes)*100)?>%">
              <?=@round(($poll_answer['votes']/$total_votes)*100)?>%
            </div>
          </div>
          <?php endforeach; ?>
      </div>
    </div>
    <div style="height: 75px; padding: 10px; text-align: center">
      <footer><h1>© Copyright 2021 Vaishnavi B</h1></footer>
    </div>
  </body>
</html>
