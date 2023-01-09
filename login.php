<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		PHP LOGIN SYSTEM
	</title>
	<link rel="stylesheet" type="text/css" href="styles/login.css">
</head>
<body>
	<div id="frm">
		<h1>Login</h1>
		<form name="f1" action="authentication.php" onsubmit="return validation()" method="POST">
			<p>
				<label>Username: </label>
				<input type="text" id="user" name="user" />  <!-- user -->
			</p>
			<p>
				<label>Password: </label>
				<input type="password" id="pass" name="pass" /> <!-- pass -->
			</p>
			<p>
				<a href="index.php" style="text-decoration: none;">Go Back</a>
			</p>
			<p>
				<input type="submit" id="btn" value="Login" name="login-submit"> <!-- login-submit --> 
			</p>
		</form>
	</div>
	<script>
		function validation()
		{
			var id=document.f1.user.value;
			var ps=document.f1.pass.value;
			if (id.length=="" && ps.length=="") {
				alert("Username and Password fields are empty");
				return false;
			} else {
				if (id.length=="") {
					alert("Username field is empty");
					return false;
				}
				if (ps.length=="") {
					alert("Password field is empty");
					return false;
				}
			}
		}
	</script>
</body>
</html>