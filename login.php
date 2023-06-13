<?php
    if (isset($_POST['login'])) {
        $db = mysqli_connect("dwarves.iut-fbleau.fr","djoco", "djoco", "djoco");

        $login = htmlentities($_POST['login']);
        $pswrd = htmlentities($_POST['pswrd']);
        //$pswrd = password_hash($pswrd, PASSWORD_ARGON2I);

        $sql = "SELECT login, paswrd FROM Utilisateur WHERE login = '$login' ";
        $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Slogin = $row["login"];
                $Spswrd = $row["paswrd"];
            }
            if ($Slogin != $login || $Spswrd != $pswrd) {
                echo "<script>alert('connection impossible')</script>";
            }else{
                if ($Slogin == $login && $Spswrd == $pswrd) {
                    echo "<script>alert('connection reussi')</script>";
                    session_start();
                }
            }
        }

        mysqli_close($db);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/global.css">
        <link rel="stylesheet" href="./css/register.css">
		<link rel="icon" type="image/png" sizes="16x16" href="./img/logo.png">
        <title>Login</title>
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
                </div>
            </nav>
        </header>

        <div class="container">
            <form method="POST">
                <div>
                    <label for="login">Identifiant : </label>
                    <input type="text" name="login">
                </div>

                <div>
                    <label for="pswrd">Mot de Passe : </label>
                    <input type="password" name="pswrd">
                </div>
                
                <div class="subm">
                    <input type="submit" value="Finaliser">
                </div>


            </form>
        </div>
<!--
        <a id="top" href="#header"><img src="/img/fleche.png" /></a>
-->
    </body>
</html>