<html>
	<head>
	<title>E-Banking Home</title>
	</head>


	<?php
		session_start();
		if($_SESSION['user'])
		{
			// if session is active
		}
		else
		{
			header("location:8_login.html"); //need to be modified
		}
		$user=$_SESSION['user'];
		?>

	<body>
	<div class="container">
		<center><h2 >The User Central Page</h2></center>
		<center><h3> Welcome back <?php echo $user ?></h3></center>
		
		<br/><br/>
		<button type = "button" onclick="location.href='8_ba_check.php'" >Balance_check</button>
		
		
		<button type = "button" onclick="location.href='8_fund_transfer.php'" >Fund_Transfer</button>
	
	
		<button type = "button" onclick="location.href='8_view_last_five_tran.php'" >Last_5_Transactions</button>

		<center><b><a href="8_logout.php" >Click Here to Logout.</a><br/></b></center>

	</div>
	</body>
	
</html>
