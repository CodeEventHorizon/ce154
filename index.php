<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>NoSTeam~^$</title>
        <link href="styles/styles.css" rel="Stylesheet" type="text/css" />
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
            <section id="dl-image">
                <div class="dl-marketing-text">
                    <h1><span>Gaming</span> 24/7</h1>
                    <h5>Some text about a Game</h5>
                    <button>Read More</button>
                </div>
            </section>

            <section id="latest-news">
                <div class="flex">
                    <h5>Latest News</h5>
                    <div id="latest-news-container">
                        <div class="latest-news-item">
                            <span class="badge new">New</span>
                            <span class="latest-news-text">Dying Light 2 will be released in Sprint of 2020</span>
                        </div>
                    </div>
                </div>
            </section>
            <section id="posts-comments">
                <div class="flex">
                    <div class="posts-comments-box">
                        <h3>Latest Posts</h3>
                        <div class="post-item">
                            <img src="images/rimworld.jpg" />
                            <div>
                                <h5>June 21, 2019</h5>
                                <p>RimWorld</p>
                                <small>By: Admin</small>
                            </div>
                        </div>

                        <div class="post-item">
                            <img src="images/shadowrundf.jpg" />
                            <div>
                                <h5>June 21, 2019</h5>
                                <p>Shadowrun: Dragonfall - Director's Cut</p>
                                <small>By: Admin</small>
                            </div>
                        </div>

                        <div class="post-item">
                            <img src="images/wow.jpg" />
                            <div>
                                <h5>June 21, 2019</h5>
                                <p>World of Warcraft</p>
                                <small>By: Admin</small>
                            </div>
                        </div>
                    </div>

                    <div class="posts-comments-box">
                        <h3>Top Comments</h3>
                        <div class="comments-item">
                            <img src="images/Hasaki.jpg" />
                            <div>
                                <p><span class="author">Yasuo</span> <span>commented</span> Hasaki!</p>
                                <h5>June 21, 2019</h5>
                            </div>
                        </div>

                        <div class="comments-item">
                            <img src="images/DioBrando.jpg" />
                            <div>
                                <p><span class="author">Dio Brando</span> <span>commented</span> Huh, Mukatta kuruno ka?</p>
                                <h5>June 21, 2019</h5>
                            </div>
                        </div>

                        <div class="comments-item">
                            <img src="images/Ricardo.jpg" />
                            <div>
                                <p><span class="author">Ricardo Milos</span> <span>commented</span> Vi sitter i Ventrilo och spelar DotA </p>
                                <h5>June 21, 2019</h5>
                            </div>
                        </div>

                        <div class="comments-item">
                            <img src="images/knuckles.jfif" />
                            <div>
                                <p><span class="author">Mr. Knuckles</span> <span>commented</span> Do you know de wae?</p>
                                <h5>June 21, 2019</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        

        <script>
            document.getElementById('nav-toggle').addEventListener('click', function () {
                let navMenu = document.getElementById('nav-menu-container');
                navMenu.style.display = navMenu.offsetParent === null ? 'block' : 'none';
            });
        </script>
    </body>
</html>