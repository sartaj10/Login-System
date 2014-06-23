<?php
session_start();
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Type B users</title>

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="signin/signin.css" rel="stylesheet">
  </head>

  <body>

	<p><strong><?php echo "Welcome $email"; ?></strong></p>

	<?php
		
		$connection = mysqli_connect("localhost","root","","health");
		$query = "SELECT uploads FROM health WHERE flag IS NULL ";
		
		$result = mysqli_query($connection,$query);
		
		while($row = mysqli_fetch_array($result)) 
		{	
		
			if(!empty($row['uploads']))
			{	
	
				echo '<img src = " upload/'.$row['uploads'].'"class = "img-thumbnail" >';

		?>
			<input type="submit" class="btn btn-success" name = "button"  />

		<?php
				if(isset($_POST['button']))
				{
				$flag = 1;	
				$query1 = " UPDATE health SET flag = 1 ";
				}
				
			}
	}
		?>
	
	
	
    </div> <!-- /container -->
		      <form class="form-signin">

			<a href = "logout.php" class = "btn btn-lg btn-primary btn-block">Logout</a>
	</form>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
