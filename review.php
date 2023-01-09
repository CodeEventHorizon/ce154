<?php
session_start();

include('connection.php');

if (isset($_GET['reviewButton'])) {
	$commented = $_GET['textArea'];
	echo $_SESSION['id'];
	echo "<br />";
	echo $_GET['hiddenGameID1'];
	echo "<br />";
	echo $_GET['ratingReviewed'];
	echo "<br />";
	echo $_SESSION['user'];
	echo "<br />";
	echo $commented;
	$deleteReview = 'DELETE FROM reviews WHERE user_id = "'.$_SESSION['id'].'" AND game_id = "'.$_GET['hiddenGameID1'].'"';
	mysqli_query($con, $deleteReview);
	$reviewSQL = 'INSERT INTO reviews (id, user_id, game_id, rating, title, review) VALUES ('.$_SESSION['id'].', '.$_SESSION['id'].', '.$_GET['hiddenGameID1'].', '.$_GET['ratingReviewed'].', "'.$_SESSION['user'].'", "'.$commented.'")';// int, int, int, int, varchar150, text
	$reviewResult = mysqli_query($con, $reviewSQL);
	header("Location: catalogue.php");
	exit();			
}

?>

