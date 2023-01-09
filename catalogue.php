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
            <section id="search">
                <div class="flex">
                    <form method="post" action="search.php">
                        <div class="search-box">   
                            <input class="search-txt" id="myInput" type="text" name="search" autocomplete="off" placeholder="Type to search">
                            <input class= "search-btn" id="submitId" name="submit-search" type="submit" value="" style="background-image: url('images/search-icon.ico');border:none; background-repeat:no-repeat; background-size: 100% 100%; background-color: transparent;">
                        </div>
                    </form>
                        <div style="margin-top: 50px;">
                            <form method="post" action="search.php">
                                <a id="login-register-button" href="catalogue.php">Show all</a>
                                <input id="login-register-button" name="fps" type="submit" value="First Person Shooter" style="border: none;">
                                <input type="hidden" name="fpshidden" value="fps">
                                <input id="login-register-button" name="rpg" type="submit" value="Role-Playing Game" style="border: none;">
                                <input type="hidden" name="rpghidden" value="rpg">
                                <input id="login-register-button" name="sim" type="submit" value="Simulation Game" style="border: none;">
                                <input type="hidden" name="simhidden" value="sim">
                                <input id="login-register-button" name="str" type="submit" value="Strategy" style="border: none;">
                                <input type="hidden" name="strhidden" value="str">
                                <input id="login-register-button" name="???" type="submit" value="Other" style="border: none;">
                                <input type="hidden" name="???hidden" value="???">
                                <?php  
                                if ($_SESSION['admin'] == 1) {
                                    include("connection.php");
                                    $checkId = "SELECT id FROM games ORDER BY id";
                                    $checkIdResult = mysqli_query($con, $checkId);
                                    $checkIdResultQuery = mysqli_num_rows($checkIdResult);
                                    if ($checkIdResultQuery > 0) {
                                        while ($checkRow = mysqli_fetch_assoc($checkIdResult)) {
                                            echo "<h5 style='color:white'>game id occupied: ".$checkRow['id']."</h5>";
                                        }
                                    }
                                    echo "<br /><h5 style='color:white;'>Add a new game: </h5>
                                    <form method='post' action='catalogue.php'>
                                        <h6 style='color:white'>id (ONLY INTEGERS): </h6> <input type='text' name='admin-id-submit'>
                                        <h6 style='color:white'>Title: </h6> <input type='text' name='admin-name-submit'>
                                        <h6 style='color:white'>Image: </h6> <input type='text' name='admin-image-submit'>
                                        <h6 style='color:white'>GenreID (3 chars): </h6> <input type='text' name='admin-genre-submit-s'>
                                        <h6 style='color:white'>Rating: </h6> <input type='text' name='admin-rating-submit'> <input type='submit' name='admin-button'>
                                    </form>
                                    ";
                                }
                                ?>
                            </form>
                        </div>
                    
                </div>
            </section>
            <section id='list-of-games'>
                <div class='games-list'>
                    <ul id='myUL'>
                        <div class='games-container'>
                            <li><span class='strip'></span>
                                <?php
                                    include("connection.php");
                                    $query = "SELECT games.id as gamesid, games.title as gamesTitle, genres.id as genresid, genres.title as genresTitle, games.image, games.rating FROM games INNER JOIN genres ON games.genre = genres.id ORDER BY gamesid;";
                                    $result = mysqli_query($con, $query);
                                    $queryResults = mysqli_num_rows($result);
                                    if ($queryResults > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $gameTitle = $row['gamesTitle'];
                                            $gameid = $row['gamesid'];
                                            /* WE ARE USING GET METHOD BECAUSE IT CAN BE BOOKMARKED, UNLIKE POST METHOD*/
                                            echo '<form method="get" action="gamePage.php">   
                                            <div class="description-of-games">
                                                Genre: '.$row["genresTitle"].'<br />Rating: '.$row["rating"].' 
                                            </div>
                                            
                                            <input name="name" type="submit" value="'.$gameTitle.'" style="background:none; font-size:40px; border:none; color:white;">
                                            <input type="hidden" name="hiddenid" value="'.$gameid.'">
                                            <br /><br />
                                            <img src="'.$row["image"].'">
                                            

                                            <br /><span class="strip"></span>
                                            </form>';
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