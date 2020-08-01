<html>
	<head>
	<title>Chk Tran Details</title>
	</head>
	<body>
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

		$conn = new mysqli("localhost", "root", "seedubuntu", "bankdb");
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
    	}

    	?>

    	<b><u><h2 ><center>The Transation Details of <?php echo $user ?></center></h2></u></b>

    <?php

    	$sql2 = "SELECT * FROM ba_info WHERE name = '$user'";
    	$result2 = $conn->query($sql2);
    	$row2 = $result2->fetch_assoc();
    	//$current_user_bal = $row2['balance'];
    	$current_user_acc_no = $row2['acc_no'];

    	//echo $current_user_acc_no;
    	

    	

    	$sql4 = "SELECT * FROM tran_details WHERE sour_acc_no = '$current_user_acc_no' OR dest_acc_no = '$current_user_acc_no' 
    			 ORDER BY ID DESC LIMIT 5";
    	$result4= $conn->query($sql4);
    	$row4 = $result4->fetch_assoc();
    	if($row4 == 0)
    	{
    		Print '<script>alert("No Transaction So Far !!");</script>';
			Print '<script>window.location.assign("8_home.php");</script>';
    	}
    	
    	$sql3 = "SELECT * FROM tran_details WHERE sour_acc_no = '$current_user_acc_no' OR dest_acc_no = '$current_user_acc_no'
    			 ORDER BY ID DESC LIMIT 5";
    	$result3= $conn->query($sql3);

    	if ($result3) 
    	{
        //print out the result

        	while ($row3 = $result3->fetch_assoc()) 
        	{
        	    printf("ID : %4u -- sour_acc_no: %6u -- dest_acc_no : %6u -- amount : %u ", $row3['ID'], $row3['sour_acc_no'], 
        	    														$row3['dest_acc_no'], $row3['amount']);
        	    ?><br><br><?php
        	}
        
    	}
    	
    	//echo $user;
    	?>
    	<center><b><a href="8_home.php" >Click Here to return Home</a><br/></b></center>
    	<?php

    	$result2->free();
        $result3->free();
        $result4->free();
        $conn->close();
	?>
	</body>
</html>
