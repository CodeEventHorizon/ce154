<?php
$host = "cseemyweb.essex.ac.uk";
$user = "nm19311";
$password = "T1ARVrKmsIZnY";
$db_name = "ce154_nm19311";

$con = mysqli_connect($host,$user,$password,$db_name);
if (mysqli_connect_errno()) {
	die("Failed to connect with MySQL: ".mysqli_connect_error());
}
?>