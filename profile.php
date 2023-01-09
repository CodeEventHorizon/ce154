<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>NoSTeam~^$</title>
        <link href="styles/styles3.css" rel="Stylesheet" type="text/css" />
    </head>

    <body>
        <header>
            <div class="flex">
                <nav>
                    <ul id="nav-menu-container">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="catalogue.php">Games</a></li>
                        <li><a href="bookmarks.php">Bookmarks</a></li>
                        <li><a href="profile.php">Profile</a></li>
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
        		<div>
        			<h1 style="color: white; text-align: center;">Hello <?php echo $_SESSION['user'];?></h1><br />
        			<h1 style="color: white; text-align: center;">
        				Rank:  
        				<?php 
        					if ($_SESSION['admin'] == 1) {
        						echo "Admin";
        					} else {
        						echo "User";
        					}
        				?>
        					
        			</h1>
        		</div>
        	</section>
        </main>

    </body>
</html>