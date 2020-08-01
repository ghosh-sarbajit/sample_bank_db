<html>
	<head>
	<title>Fund Transfer Action Page</title>
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
	

	<?php 
	//echo $user;
	
	$dest_acc_no = $_POST['dest_acc_no'];
	$amount_to_trnsfer = $_POST['amount'];
	echo $dest_acc_no;
	echo $amount_to_trnsfer;

	/*CSRF counter measure starts*/
	$token = $_POST['CSRFToken'];
	if($token != 'jshdjdhksfshhsf')
	{
		Print '<script>alert("honesty is the best policy !!!");</script>';
		session_destroy();
		Print '<script>window.location.assign("8_login.html");</script>';
		exit();
	}
	/*CSRF counter measure ends*/
 
	$conn = new mysqli("localhost", "root", "seedubuntu", "bankdb");
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
    }

    
    $sql1 = "SELECT * FROM ba_info WHERE acc_no = '$dest_acc_no'";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    if($row1 == 0)
    {
    	//echo "Hi !!!";
    	Print '<script>alert("OMG Invalid dest_acc_no !!!");</script>';
		Print '<script>window.location.assign("8_fund_transfer.php");</script>';
    }

    if($row1 > 0)
    {
    	$sql2 = "SELECT * FROM ba_info WHERE name = '$user'";
    	$result2 = $conn->query($sql2);
    	$row2 = $result2->fetch_assoc();
    	$current_user_bal = $row2['balance'];
    	$current_user_acc_no = $row2['acc_no'];
    	//echo $current_user_bal;
    	if($current_user_bal >= $amount_to_trnsfer && $amount_to_trnsfer > 0)
    	{
    		//echo "Ha Ha !!";
    		$new_sor_acc_bal = $current_user_bal - $amount_to_trnsfer;
    		$new_dest_acc_bal = $row1['balance'];
    		//echo $new_dest_acc_bal;
    		$new_dest_acc_bal = $new_dest_acc_bal + $amount_to_trnsfer;
    		$sql31 = "UPDATE ba_info SET balance='$new_sor_acc_bal' 
					  WHERE acc_no='$current_user_acc_no'";
			$result31 = $conn->query($sql31);
			$sql32 = "UPDATE ba_info SET balance='$new_dest_acc_bal' 
					  WHERE acc_no='$dest_acc_no'";
			$result32 = $conn->query($sql32);

			//echo $current_user_acc_no;
			//echo $dest_acc_no;
			//echo $amount_to_trnsfer;

			$sql4 = "INSERT INTO tran_details(sour_acc_no,dest_acc_no,amount) 
					 VALUES ('$current_user_acc_no','$dest_acc_no','$amount_to_trnsfer')";
			$result4 = $conn->query($sql4);

			Print '<script>alert("Hurrah transaction successful !!!");</script>';
			Print '<script>window.location.assign("8_home.php");</script>';


    	}
    	else
    	{
    		Print '<script>alert("Inconsistency in entered amount !!!");</script>';
			Print '<script>window.location.assign("8_fund_transfer.php");</script>';
    	}
    }
    $result1->free();
    $result2->free();
    $result31->free();
    $result32->free();
    $result4->free();
    $conn->close();
	?>
</html>
