<DOCTYPE html>
<html>
<head>
	<title>Fund Transfer Form</title>
</head>
<?php
		session_start();
		//echo "Hello";
		if($_SESSION['user'])
		{

		}
		else
		{
			header("location:8_login.html");
		}
		$user = $_SESSION['user'];
		//echo $user;
		?>
<body>
	<div class="container">
		<b><u><h2 ><center>Fund Transfer Form</center></h2></u></b>
		<form action="8_fund_transfer_action.php" method="POST">
			<!---CSRF counter measure starts-->
			<input type="hidden" name="CSRFToken" value="jshdjdhksfshhsf">
			<!---CSRF counter measure ends-->
			Enter dest_acc_no : <input type="text" name="dest_acc_no" required="required"/><br/>
			Enter amount : <input type="text" name="amount" required="required"/><br/>
			<input type="submit" value="Proceed" class="button"/>
		</form>

	<center><a href="8_home.php" >Return home</a><br/></center>	
	</div>
	</body>
</body>
</html>