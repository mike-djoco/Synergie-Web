<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navbar.css">
    <title>Document</title>
</head>

<body>
    <nav class="navbar">
        <h1>
            Barcelone
        </h1>
        <a href="./index.php">Accueil</a>
        <a href="#">Contact</a>
        <a href="./modification.php">Compte</a>
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