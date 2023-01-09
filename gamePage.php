<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>NoSTeam~^$</title>
		<link href="styles/styles2.css" rel="Stylesheet" type="text/css" />
	</head>

	<body>
		<header>
            <div class="flex">
                <nav>
                    <ul id="nav-menu-container">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="catalogue.php">Games</a></li>
                        <?php
                        if (isset($_SESSION["user"]) || isset($_SESSION['id'])) {
                            echo '<li><a href="bookmarks.php">Bookmarks</a></li>';
                            echo '<li><a href="profile.php">Profile</a></li>';
                        }
                        ?>
                        <li style="color: white;"> 
                            <?php 
                            if(isset($_SESSION['user']))
                                echo "Hello ". $_SESSION['user']; 
                            ?>            
                        </li>
                    </ul>
                </nav>
                <?php
                if (isset($_SESSION['user']) || isset($_SESSION['id'])) {
                    echo '<a href="logout.php" id="login-register-button">Logout</a>';
                } else {
                echo '<a href="login.php" id="login-register-button">Login</a>';
                }
                ?> 
            </div>
        </header>
        <main>
            <section>
                    <div class="gamePage-div">
                        <?php
                            include("connection.php");
                            $query = "SELECT games.id as gamesid, games.title as gamesTitle, genres.id as genresid, genres.title as genresTitle, games.image, games.rating FROM games INNER JOIN genres ON games.genre = genres.id ORDER BY gamesid;";
                            $result = mysqli_query($con, $query);
                            $queryResults = mysqli_num_rows($result);
                            if ($queryResults > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if($row['gamesid'] == $_GET['hiddenid']) {
                                        echo "
                                        <h1 style='color:white; text-align:center;'>".$row['gamesTitle']."</h1>
                                        <img src='".$row['image']."' class='gamePageImg' style='display: block; margin-left: auto; margin-right: auto; width: 500px; height: 500px;'>
                                        <span class='strip'></span>
                                        <h6 style='color:white; font-size: 20px; position:relative; margin-left: 20px;'>Rating: ".$row['rating']."</h6>
                                        <h6 style='color:white; font-size: 20px; position:relative; margin-left: 20px;'>Genre: ".$row['genresTitle']."</h6>";
                                        if (isset($_SESSION["user"]) || isset($_SESSION['id'])) {
                                            $userid = $_SESSION['id'];
                                            $gameid = $row['gamesid'];
                                            echo "<form method='post' action='bookmarks.php'>
                                            <input name='book' type='submit' value='Add to bookmarks' style='background-color: #FFB320; color: #131313; border-radius: 20px; padding: 10px 15px; font-size: 0.85em; font-weight: 600; display:block; margin-right: auto; margin-left: auto; width: 150px; margin-top: -80px;'>
                                            <input name='hiddenBook' type='hidden' value='".$gameid."'>
                                            </form>"; // ADD
                                        }
                                        echo "<span class='strip'></span>";
                                        if (isset($_SESSION["user"]) || isset($_SESSION['id'])) {
                                            echo '
                                            <form action="review.php" method="get">
                                                <textarea rows="10" name="textArea" style="width:500px; resize:none;">Leave a review</textarea><br />
                                                <input type="text" name="ratingReviewed" placeholder="rate the game 1 to 100"><br /><br />
                                                <input style="margin-left:420px; margin-bottom:100px;" id="login-register-button" type="submit" value="Submit" name="reviewButton">
                                                <input type="hidden" name="hiddenGameID1" value="'.$gameid.'">
                                            </form>
                                            ';
                                        }
                                        $reviewQuery = 'SELECT*FROM reviews';
                                        $reviewQueryResult = mysqli_query($con, $reviewQuery);
                                        while ($reviewQueryRow = mysqli_fetch_assoc($reviewQueryResult)) {
                                            if ($reviewQueryRow['id'] == $reviewQueryRow['user_id'] && $_GET['hiddenid'] == $reviewQueryRow['game_id']) {
                                               echo '<h3 style="color:white;">Reviews: </h3><br />
                                               <h4 style="color:white;">User: '.$reviewQueryRow['title'].'</h4>
                                               <h5 style="color:white;">Rating: '.$reviewQueryRow['rating'].'</h5>
                                               <h5 style="color:white;">Comment: '.$reviewQueryRow['review'].'</h5>';
                                            }
                                        }
                                                
                                    }
                                }
                            }
                        ?>
                    </div>      
            </section>
        </main>
    </body>
</html>