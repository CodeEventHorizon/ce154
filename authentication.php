<?php
if (isset($_POST['login-submit'])) {
	/* i got very confused about hashing part so instead im using hash as a password instead of password_verify()*/
	include("connection.php");
	$username = $_POST["user"];
	$password = $_POST["pass"];
	//sql injection prevention
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysqli_real_escape_string($con,$username);
	$password = mysqli_real_escape_string($con,$password);
	/* start: login query */
	$sql = "SELECT * FROM users WHERE uname = '$username' and pass = '$password'";
	$stmt = mysqli_stmt_init($con);
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	//$count = mysqli_num_rows($result);
	
	if ($row["pass"] != $password) {
		header("Location: catalogue.php?error=wrongpwd");
		exit();
	} elseif($row["pass"] == $password) {
		session_start();
		$_SESSION['id'] = $row['id'];   // id
		$_SESSION['user'] = $row['uname'];  // uname
		$_SESSION['admin'] = $row["is_admin"];
		header("Location: catalogue.php?Success");
		exit();
	} else {
		header("Location: catalogue.php?error=wrongpwd");
		exit();
	}
}

/*
	if ($count ==1) {
		session_start();
		header("Location: catalogue.php?LoggedIn");
		exit();
	} else {
		header("Location: login.php?UsernameOrPasswordINCORRECT");
		exit();
	} 
}*/
?>