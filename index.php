<?php 
    session_start();
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/global.css">
        <link rel="stylesheet" href="./css/index.css">
        <title>Acceuil</title>
    </head>
    
    <body>
        <header id="header">
            <nav>
                <img class="logo" src="img/logo.png"/>
                <p id="tittle">Connection</p>
                <div class="link">
                    <a href="./index.php">HOME</a>
                    <a href="#">CONTACT</a>
                    <a href="./register.php">Inscription</a>
                    <a href="./modification.php">Account</a>
                </div>
                <div class="nav-action">
                <?php
                if (isset($_SESSION['user_auth'])) {
                    echo '
                        <form action="deconnecter.php">
                            <input type="submit" value="Déconnexion">
                        </form>
                    ';
                }

                if(!isset($_SESSION['user_auth'])){
                    echo '
                        <form action="login.php">
                            <input type="submit" value="Connection">
                        </form>
                    ';
                }
                ?>
        </div>
            </nav>
        </header>

        <div class="container">
            <h1>Main Page</h1>
            <?php 
                if (isset($_SESSION['user_auth'])) {
                    echo "bonjour vous etes connecte";
                }
            ?>
        </div>
    </body>
</html>