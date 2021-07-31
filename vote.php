<?php
  require('db.php');
  $msg = '';
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM `polls` WHERE (id = '$id')";
    $res = mysqli_query($con, $query);

    $poll = mysqli_fetch_assoc($res);

    if($poll){
      $query = "SELECT * FROM `poll_answers` WHERE  (poll_id = '$id')";
      $res = mysqli_query($con, $query);
      $poll_answers = mysqli_fetch_all($res, MYSQLI_ASSOC);
      $_SESSION['username']['status'] == 1;
      if(isset($_POST['poll_answer'])){
        $pollid = $_POST['poll_answer'];
        $query = "UPDATE `poll_answers` SET votes = votes + 1 WHERE id = '$pollid'";
        $res = mysqli_query($con, $query);
        $msg = 'success';
        echo $msg;
        header('Location: poll_index.php');

        exit;
      }
      }else{
        exit('Poll with that ID does not exist.');
      }
  }  else{
    exit('No poll ID specified.');
  }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Vote</title>
  </head>
  <body>
    <?php session_start(); ?>
    <div class="">
      <h2><?=$poll['title'] ?></h2>
      <p><?= $poll['description'] ?></p>
      <img src = "uploads/<?php echo $poll['photo']; ?>" heigth="200" width="200">

      <form action="vote.php?id=<?= $_GET['id']?>" method="post">
        <?php for($i = 0; $i < count($poll_answers); $i++): ?>
        <label>
          <input type="radio" name="poll_answer" value="<?= $poll_answers[$i]['id']?>"<?=$i == 0 ? ' checked' : ''?>>
          <?= $poll_answers[$i]['title'] ?>
        </label>
      <?php endfor; ?>
      <div>
        <input type="submit" name="" value="Vote">
        <a href="result.php?id=<?=$poll['id']?>">View Result</a>
      </div>
      </form>
    </div>
  </body>
</html>
