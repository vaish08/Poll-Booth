<?php
  require('db.php');
  require('auth_session.php');
  $msg = '';
  if(isset($_GET['id'])){
    $username = $_SESSION["username"];
    // if(!isset($_SESSION['voted'],$_SESSION['voted'][(string)$_GET['id']])){
    // if(!isset($_SESSION['voted'])) $_SESSION['voted'] = array();
    // $_SESSION['voted'][(string)$_GET['id']] = true;
    $id = $_GET['id'];
    //setcookie($_SESSION["username"], $id);
    //setcookie($username[$id], "1");
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
    <link rel="stylesheet" href="style/css_poll.css">
  </head>
  <body>
    <div class="content poll-vote">
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
