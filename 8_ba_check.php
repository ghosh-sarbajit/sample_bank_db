<html>
	<head>
	<title>Bank Balance</title>
	</head>
	<?php
		session_start();
		if($_SESSION['user'])
		{}
		else
		{
			header("location:8_login.html");
		}
		$user=$_SESSION['user'];
		?>
	<body>

	<div class="container">
		<b><u><center><h2 >Amount In Account</h2></center></u></b>
		
		
		<h3> Hello <?php echo $user ?> your account details is as follows!!</h3>
		<br/><br/>
		<?php 
			//echo "Hello !!!";
			$conn = new mysqli("localhost", "root", "seedubuntu", "bankdb");
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
    		}
			$balance=0;
			//echo $balance;
			//echo $user;
			$sql = "SELECT * FROM ba_info WHERE name ='$user'";
			$result= $conn->query($sql);
			$row = $result->fetch_assoc();
			printf("acc_balance : %d", $row['balance']);
			$conn->close();
		 ?>

		 <center><a href="8_home.php" >Return home</a><br/></center>


	</div>
	</body>
	
</html>
