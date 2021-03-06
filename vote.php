<?php
  require('db.php');
  require('auth_session.php');
  $msg = '';
  if(isset($_GET['id'])){
    $username = $_SESSION["username"];
    $id = $_GET['id'];
    $query = "INSERT into `voted` (poll_id, user, status) VALUES ('$id', '$username', '1')";
    mysqli_query($con, $query);

    $query = "SELECT * FROM `polls` WHERE (id = '$id')";
    $res = mysqli_query($con, $query);

    $poll = mysqli_fetch_assoc($res);

    if($poll){
      $query = "SELECT * FROM `poll_answers` WHERE  (poll_id = '$id')";
      $res = mysqli_query($con, $query);
      $poll_answers = mysqli_fetch_all($res, MYSQLI_ASSOC);
      if(isset($_POST['poll_answer'])){
        $pollid = $_POST['poll_answer'];
        $query = "UPDATE `poll_answers` SET votes = votes + 1 WHERE id = '$pollid'";
        $res = mysqli_query($con, $query);
        $msg = 'success';
        echo $msg;
        if(strcmp($_SESSION["username"], "vaish") == 0)
          header('Location: poll_index_admin.php');
        else {
          header('Location: poll_index.php');
        }

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
    <link rel="stylesheet" href="style/css_poll.css">
  </head>
  <body>
    <nav class="navtop">
      <div>
        <h1>Voting and Poll System.</h1>
      </div>
    </nav>
    <div class="content poll-vote">
      <h2><?=$poll['title'] ?></h2>
      <p><?= $poll['description'] ?></p>
      <img src = "uploads/<?php echo $poll['photo']; ?>" heigth="200" width="200">

      <form action="vote.php?id=<?= $_GET['id']?>" method="post">
        <?php for($i = 0; $i < count($poll_answers); $i++): ?>
        <label>
          <input type="radio" name="poll_answer" value="<?= $poll_answers[$i]['id']?>"<?=$i == 0 ? ' checked' : ''?>>
          <?= $poll_answers[$i]['title'] ?>
        </br>
        </label>
      <?php endfor; ?>
      <div>
        <input type="submit" name="vote" value="Vote">
      </div>
      </form>
    </div>
    <div style="height: 75px; padding: 10px; text-align: center">
      <footer><h1>?? Copyright 2021 Vaishnavi B</h1></footer>
    </div>
  </body>
</html>
