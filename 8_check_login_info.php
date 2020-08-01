<html>
<?php
	session_start();
	$name= $_POST['name'];
	$pass= $_POST['pass'];

	$conn = new mysqli("localhost", "root", "seedubuntu", "bankdb");
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
    }

    //Block vulnerable to sql injection
    /*$sql = "SELECT * FROM log_cred WHERE name = '$name' AND pass = '$pass'";
    $result6= $conn->query($sql);
    $row6 = $result6->fetch_assoc();
    //echo $row6['name'];
    if($row6 > 0)
    {
    	$_SESSION['user']= $row6['name'];
		header("location:8_home.php");
    }*/
    
    //block with security
    $query="SELECT * FROM log_cred WHERE name = ?";
 	if($row = $conn->prepare($query))
 	{
 		
 		$row->bind_param("s",$name);
 		$row->execute();
 		$row->bind_result($acc_no_q,$name_q,$pass_q);
 		$row->fetch();
 		//echo "Hi";
 	}
 	else
 	{
 		echo "failed";
 	}
	if($name == $name_q)
	{
		if($pass == $pass_q)
		{
			$_SESSION['user']= $name_q;
			header("location:8_home.php");
		}
		else
		{
			Print '<script>alert("OMG Incorrect Password!");</script>';
			Print '<script>window.location.assign("8_login.html");</script>';
		}
	}
	else
	{
		Print '<script>alert("OMG Username not valid!");</script>';
		Print '<script>window.location.assign("8_login.html");</script>';
	}
	$conn->close(); 
 ?>
 </html>

