<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>NoSTeam~^$</title>
		<link href="styles/styles2.css" rel="Stylesheet" type="text/css" />
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
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
            <section id='list-of-games'>
                <div class='games-list'>
                    <ul id='myUL'>
                        <div class='games-container'>
                            <li><span class='strip'></span>
                                <?php
                                    include("connection.php");
                                    $query = "SELECT games.id as gamesid, games.title as gamesTitle, genres.id as genresid, genres.title as genresTitle, games.image, games.rating, users.id as uid, bookmarks.user_id, bookmarks.game_id FROM games INNER JOIN genres ON games.genre = genres.id INNER JOIN bookmarks ON bookmarks.game_id = games.id INNER JOIN users ON bookmarks.user_id = users.id ORDER BY games.id;";
                                    $result = mysqli_query($con, $query);
                                    $queryResults = mysqli_num_rows($result);
                                    if (isset($_POST['book'])) {
                                        $passedGameid = $_POST['hiddenBook'];
                                        $activeUser = $_SESSION['id'];
                                        $deleteDup = "DELETE FROM bookmarks WHERE user_id = ".$activeUser." AND game_id = ".$passedGameid."";
                                        mysqli_query($con, $deleteDup);
                                        $insertQuery = 'INSERT INTO bookmarks (user_id, game_id)
                                            VALUES ("'.$activeUser.'", "'.$passedGameid.'");';
                                        mysqli_query($con, $insertQuery);
                                        header("Location: bookmarks.php");
                                        exit();
                                    }
                                    if (isset($_GET['removeBook'])) {
                                        $rbh = $_GET['removeBookHidden'];
                                        $removeBooked = "DELETE FROM bookmarks WHERE user_id = ".$_SESSION['id']." AND game_id = ".$rbh."";
                                        mysqli_query($con, $removeBooked);
                                        header("Location: bookmarks.php");
                                        exit();
                                    }
                                    
                                    if ($queryResults > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $gameTitle = $row['gamesTitle'];
                                            $gameid = $row['gamesid'];
                                            if ($_SESSION['id'] == $row['user_id']) {
                                                if ($row['gamesid'] == $row['game_id']) {
                                                    /* WE ARE USING GET METHOD BECAUSE IT CAN BE BOOKMARKED, UNLIKE POST METHOD*/
                                                    echo '   
                                                    <div class="description-of-games">
                                                        Genre: '.$row["genresTitle"].'<br />Rating: '.$row["rating"].'
                                                        <form method="get" action="bookmarks.php">
                                                            <input name="removeBook" type="submit" value="Remove from bookmarks" style="background-color: #FFB320; color: #131313; border-radius: 20px; padding: 10px 15px; font-size: 0.85em; font-weight: 600; display:block; margin-right: auto; margin-left: auto; width: 190px;""> 
                                                            <input name="removeBookHidden" value="'.$row['game_id'].'" type="hidden">
                                                        </form>
                                                    </div>
                                                    <form method="get" action="gamePage.php">
                                                        <input name="name" type="submit" value="'.$gameTitle.'" style="background:none; font-size:40px; border:none; color:white;">
                                                        <input type="hidden" name="hiddenid" value="'.$gameid.'">
                                                    </form>
                                                    <br /><br />
                                                    <img src="'.$row["image"].'">
                                                    

                                                    <br /><span class="strip"></span>
                                                    ';
                                                }
                                            }
                                            
                                        }
                                    }
                                ?>
                            </li>
                        </div>
                   </ul>
                </div>
            </seaction>
        </main>
    </body>
</html>