<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create Poll.</title>
    <link rel="stylesheet" href="style/css_poll.css">
  </head>
  <body>
    <?php
      $msg = '';
      require('db.php');

      if(isset($_REQUEST['upload'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_FILES['photo']['name'];
        $tempname = $_FILES['photo']['tmp_name'];
        $folder = "uploads/".$image;
        $deadline = $_POST['deadline'];

        $query = "INSERT INTO `polls` (photo, title, description, deadline) VALUES ('$image', '$title', '$description', '$deadline')" ;
        echo $deadline;
        mysqli_query($con, $query);

        move_uploaded_file($tempname, $folder);

        $poll_id = mysqli_insert_id($con);

        $answers = isset($_POST['answers'])? explode(PHP_EOL, $_POST['answers']) : '';
        foreach($answers as $answer){
          if(empty($answer)) continue;

          $query = "INSERT INTO `poll_answers` (poll_id, title) VALUES ('$poll_id', '$answer')";
          mysqli_query($con, $query);
        }

        $msg = 'Created Succesfully';
        header('Location: poll_index_admin.php');
        //header('Location: create.php');


      }
    ?>

     <div class="content update">
       <h2>Create Poll</h2>
       <form class="" action="create.php" method="post" enctype="multipart/form-data"><br>
        <label for="title">Title</label><br>
        <input type="text" name="title" id="title" placeholder="Title" required> <br>
        <label for="description">Description</label><br>
        <input type="text" name="description" id="description" placeholder="Description"><br>
        <label for="answers">Answers (per line)</label><br>
        <textarea name="answers" id="answers" placeholder="Description" required></textarea><br>
        Upload file.
        <input type="file" name="photo" ><br>
        <label for="deadline">Deadline</label><br>
        <em>Note: Time is 24hr formate </em>
        <input type="text" name="deadline" id="deadline" placeholder="dd/mm/yyyy hh/mm"><br>
        <input type="submit" value="Create" name="upload">

        <p>
          Click here to <a href="logout.php"> Logout.</a>
        </p>
       </form>


       <?php if ($msg): ?>
         <p><?=$msg?></p>
       <?php endif; ?>
     </div>
  </body>
</html>
