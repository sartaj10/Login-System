<!DOCTYPE html>
<html>
  <head>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <form class="form-signin" method = "POST" action="">
        <h2 class="form-signin-heading">Sign Up</h2>
        <input type="text" class="form-control" name = "name" placeholder="Full Name" autofocus required>
        <input type="email" class="form-control" name = "email" placeholder="Email address" autofocus required>
        <input type="password" class="form-control" name = "pass" placeholder="Password" required>
        <input type="password" class="form-control" name = "cpass" placeholder="Confirm Password">
        <label for="genders" > Please select your gender </label>
        <div class="row">
          <div class="col-lg-6">
            <div class="input-group">
              <span class="input-group-addon">
                <input type="radio" value="M" name="gender" > Male
                <input type="radio" value="F" name ="gender" > Female
              </span>
            </div><!-- /input-group -->
          </div>
        </div><!-- /row -->
        <label for="types" > Please select your Type </label>
        <div class="row">
          <div class="col-lg-6">
            <div class="input-group">
              <span class="input-group-addon">
                <input type="radio" value="A" name="type" > Type A <br><br>
                <input type="radio" value="B" name ="type" > Type B
              </span>
            </div><!-- /input-group -->
          </div>
        </div><!-- /row -->
        <button class="btn btn-lg btn-primary btn-block" name = "submit" type="submit">Register</button>
        <br>
        <p> <strong> Already a member? Sign in </strong> <a href = "signin.php"> here </a></p>

        <?php

          include 'config.inc.php';

          if (isset($_POST['submit'])) {
            if ($_POST['pass'] == $_POST['cpass']) {
              $name = $_POST['name'];
              $gender =$_POST['gender'];
              $email = $_POST['email'];
              $pass = $_POST['pass'];
              $type = $_POST['type'];

              $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
              $salt = substr(str_replace('+', '.', base64_encode(sha1(microtime(true), true))), 0, 22);
              $pass_hash = crypt($pass, '$2a$12$'.$salt);
              $query = "INSERT INTO " .$tableName. "(name, user_email, pass_hash, salt, gender, type) VALUES('$name', '$email', '$pass_hash', '$salt', '$gender', '$type')";
              $result = mysqli_query($connection, $query);
              if (!$dev) {
                if ($result) {
                  $to = $email;
                  $subject = "Your confirmation link here";
                  $header = "from: sartajcorp@gmail.com";
                  $message = "Your Comfirmation link \r\n";
                  $message .= "Click on this link to activate your account \r\n";
                  $message .= "http://www.yourweb.com/confirmation.php?passkey=$confirm_code";
                  $sentmail = mail($to,$subject,$message,$header);
                } else {
                  echo "Not found your email in our database";
                }

                if(!$dev && $sentmail) {
                  echo "Your Confirmation link Has Been Sent To Your Email Address.";
                } else {
                  echo "Cannot send Confirmation link to your e-mail address";
                }
              }
            } else {
              echo "Passwords not matching!";
            }
          }
        ?>

      </form>
    </div>
  </body>
</html>
