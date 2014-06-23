<?php
  session_start();
  $email = $_SESSION['email'];
  $name = $_SESSION['name'];
  $user_id = $_SESSION['user_id']
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Type A users</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <p><strong><?php echo "Welcome $name"; ?></strong></p>

      <form class="form-signin" method = "POST">
        <h3 class="form-signin-heading">Type A users</h2>
        <textarea class="form-control" rows="3" placeholder = "Enter Your Description" name = "desc" ></textarea>
      </form>

      <form action="" method="post" class = "form-signin" enctype = "multipart/form-data">
        <label for="files">Filename:</label>
        <input type="file" name="files[]" id="file" class = "form-control"><br>
        <input type="submit" name="submit" value="Create New Package" class="btn btn-lg btn-primary btn-block">
        <input type="submit" name="view" value="View Your Packages" class="btn btn-lg btn-primary btn-block">
        <a href = "logout.php" class = "btn btn-lg btn-primary btn-block">Logout</a>
      </form>

      <?php

        include 'config.inc.php';

        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if (isset($_POST['submit'])) {
            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $desc = $_POST['desc'];
            $errors = array();
            foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
              $file_name = $key.$_FILES['files']['name'][$key];
              $file_size = $_FILES['files']['size'][$key];
              $file_tmp = $_FILES['files']['tmp_name'][$key];
              $file_type = $_FILES['files']['type'][$key];
              $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$key])));
              if ((($file_type == 'image/gif')
              || ($file_type == 'image/jpeg')
              || ($file_type == 'image/jpg')
              || ($file_type == 'image/pjpeg')
              || ($file_type == 'image/x-png')
              || ($file_type == 'image/png'))
              && in_array($file_ext, $allowedExts)) {
                if ($file_size < 2097152) {
                  if (!empty($errors)) {
                    print_r($errors);
                  } else {
                    $query = "INSERT into package(users_id, desc) VALUES('')";
                  }
                } else {
                  $errors[] = "File size must be less than 2MB";
                }
              } else {
                $errors[] = "File extension not allowed\n";
              }
            }
            if (empty($errors)) {
              echo "Successfully created package";
            }
          }
        
      ?>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
