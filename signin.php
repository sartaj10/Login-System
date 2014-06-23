<!DOCTYPE html>
<html>
  <head>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="signin.css" rel="stylesheet">
   </head>

  <body>

    <div class="container">
      <form class="form-signin" method = "POST" action = "">
        <h2 class="form-signin-heading">Sign in</h2>
        <input type="email" class="form-control" name = "email" placeholder="Email address" autofocus required>
        <input type="password" class="form-control" name = "password"  placeholder="Password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

      <div id = "signup">
        <p>Or you could register<a href="signup.php"> here </a>
      </div>

    </div> <!-- /container -->

    <?php

      include 'config.inc.php';

      if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        $email = mysqli_real_escape_string($connection, trim($_POST['email']));

        $query = "SELECT pass_hash, salt, type, name, id FROM " .$tableName. " WHERE user_email = '$email'";
        $result = mysqli_query($connection, $query) OR die('error in query');
        $num = mysqli_num_rows($result);
        if ($num < 1) {
          echo "Incorrect email or password. Please verify the data you entered\n";
        } else {
          session_start();
          $_SESSION['email'] = $_POST['email'];
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          $_SESSION['name'] = $row['name'];
          $_SESSION['user_id'] = $row['id'];
          $hash = crypt($pass, '$2a$12$'.$row['salt']);
          if ($hash == $row['pass_hash']) {
            $type = $row['type'];
            if ($type == 'A') {
              header('Location: proceedtypeA.php');
            } else if ($type == 'B') {
              header('Location: proceedtypeB.php');
            }
          } else {
            echo "Incorrect email or password. Please verify the data you entered\n";
          }
        }
      }
    ?>

  </body>
</html>
