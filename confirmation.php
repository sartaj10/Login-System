<?php

	$connection = mysqli_connect("localhost","root","","health");

// Passkey that got from link 
$passkey=$_GET['passkey'];

// Retrieve data from table where row that match this passkey 
$sql1="SELECT * FROM temp_health WHERE confirm_code ='$passkey'";
$result1=mysql_query($sql1);

// If successfully queried 
if($result1){

// Count how many row has this passkey
$count=mysql_num_rows($result1);

// if found this passkey in our database, retrieve data from table "temp_members_db"
if($count==1){

$rows=mysql_fetch_array($result1);
$name=$rows['name'];
$email=$rows['email'];
$pass=$rows['pass']; 

// Insert data that retrieves from "temp_members_db" into table "registered_members" 
$sql2="INSERT INTO health(name, users_email, users_pass )VALUES('$name', '$email', '$password')";
$result2=mysql_query($sql2);
}

// if not found passkey, display message "Wrong Confirmation code" 
else {
echo "Wrong Confirmation code";
}

// if successfully moved data from table"temp_members_db" to table "registered_members" displays message "Your account has been activated" and don't forget to delete confirmation code from table "temp_members_db"
if($result2){

echo "Your account has been activated";

// Delete information of this user from table "temp_members_db" that has this passkey 
$sql3="DELETE FROM temp_health WHERE confirm_code = '$passkey'";
$result3=mysql_query($sql3);

}

}
?>