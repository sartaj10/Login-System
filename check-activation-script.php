<?php
$name = $_POST['name'];
$activation_code = $_POST['activation_code'];
$connection = mysqli_connect("localhost","root","","health");

if($name == 'name' && $activation_code == 'activation')
{
echo "Congratulations. Your membership has been activated ...";
}
else{
echo ("You've entered an invalid username / activation code - please retry");
}
?>