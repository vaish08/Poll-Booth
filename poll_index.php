<?php
  require('db.php');
  require('auth_session.php');
  $query = ('SELECT p.*, GROUP_CONCAT(pa.title ORDER BY pa.id) AS answers FROM polls p LEFT JOIN poll_answers pa ON pa.poll_id = p.id GROUP BY p.id');
  $res = mysqli_query($con, $query);
  $polls = mysqli_fetch_all($res, MYSQLI_ASSOC);
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index</title>
    <link rel="stylesheet" href="style/css_poll.css">
  </head>
  <body>
    <nav class="navtop">
      <div>
        <h1>Voting and Poll System.</h1>
        <a href="logout.php">Logout</a>
      </div>
    </nav>
    <div class="content home">
      <h2>Polls</h2>
      <p style="font-size: 20px">Welcome <b><?= $_SESSION["username"]?></b> !!!</p>
      <p style="font-size: 15px">
        You will be able to see the result, after the admin ends the poll or past the deadline.
      </p><br />
      <?php
        $query = "SELECT count(*) FROM `polls`";
        $res = mysqli_query($con, $query);
        if($res == 0){
      ?>
      <h2>You have no upcoming polls.</h2>
      <?php
        }
      ?>
      <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Title</td>
				        <td>Answers</td>
                <td>Deadline</td>
                <td></td>
            </tr>
            <?php $s_no = 0; ?>
        </thead>
        <tbody>
            <?php foreach($polls as $poll): ?>
            <tr>
              <?php $s_no = $s_no + 1;?>
                <td><?= $s_no?></td>
                <td><?=$poll['title']?></td>
                <?php $id = $poll['id'];
                $username = $_SESSION["username"];?>
				        <td><?=$poll['answers']?></td>
                <td><?=$poll['deadline']?></td>

                <td class="actions">
					          <p>
                    <?php
                    $query = "SELECT * FROM `voted` WHERE (poll_id = '$id') AND (user = '$username') AND status = 1";
                    $res = mysqli_query($con, $query);

                    $date = date("d/m/Y H:i");
                    $q = "SELECT * FROM `polls` WHERE (id = '$id') AND (deadline = '$date')";
                    $r = mysqli_query($con, $q);

                    if(mysqli_num_rows($r) > 0){
                      $query    = "INSERT into `result` (poll_id) VALUES ('$id')";
                      $result   = mysqli_query($con, $query);
                    }

                    $sql = "SELECT * FROM `result` WHERE (poll_id = '$id')";
                    $result = mysqli_query($con, $sql);

                    if(mysqli_num_rows($result) > 0){
                      ?><a href="result.php?id=<?=$poll['id']?>" class="view" title="Result">View Result.</a> <?php
                    }
                    else{
                      if(mysqli_num_rows($res) > 0){
                      ?><button disabled type="submit" class="view" name="button" style="background-color: red; border: none">Voted</button> <?php
                      }
                      else{
                        ?><a href="vote.php?id=<?=$poll['id']?>" class="view" title="Vote">Vote.</a> <?php
                      }
                    }
                    ?>
                    </p>
                </td>

            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <script>
    // if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
    //     window.open("login.php", "_self");
    // }
    </script>
    <div style="height: 75px; padding: 10px; text-align: center">
      <footer><h1>© Copyright 2021 Vaishnavi B</h1></footer>
    </div>
  </body>
</html>
