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
      <p>Welcome to the home page!!</p>
      <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Title</td>
				        <td>Answers</td>
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
                <td class="actions">
					          <p>
                      <?php
                        $query = "SELECT * FROM `voted` WHERE (poll_id = '$id') AND (user = '$username') AND status = 1";
                        $res = mysqli_query($con, $query);

                        if(mysqli_num_rows($res) > 0){
                        ?>
                        <button disabled type="submit" class="view" name="button">Voted</button>
                      <?php } else{ ?>
                        <a href="vote.php?id=<?=$poll['id']?>" class="view" title="Vote">Vote.</a>
                       <?php }?>

                      <a href="result.php?id=<?=$poll['id']?>" class="view" title="Result">Result.</a>
                    </p>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="logout.php">Logout.</a>
    </div>
  </body>
</html>
