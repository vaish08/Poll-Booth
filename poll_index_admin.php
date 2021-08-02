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
    <title></title>
    <link rel="stylesheet" href="style/css_poll.css">
  </head>
  <body>
    <div class="content home">
      <h2>Polls</h2>
      <p>Welcome <?= $_SESSION["username"]?>,</p>
      <p>
        Want to create poll ?
        <a href="create.php" class="create-poll"> Create</a>
      </p>
      <div style="overflow-x: auto">
        <table>
          <thead>
              <tr>
                  <td>#</td>
                  <td>Title</td>
                  <td>Answer</td>
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
                        <a href="result.php?id=<?=$poll['id']?>" class="view" title="Result">Result.</a>
                        <?php
                        $id = $poll['id'];
                        $sql = "SELECT * FROM `result` WHERE (poll_id = '$id')";
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result) > 0){echo "";}
                        else{ ?>
                            <a href="update_result.php?id=<?=$poll['id']?>" class="view" title="Result_end" style="background-color: #00C1D4">End poll.</a>
                      <?php }?>
                      </p>
                  </td>
              </tr>
              <?php endforeach; ?>
          </tbody>
      </table>
      </div>

    <a href="logout.php">Logout.</a>
    </div>
  </body>
</html>
