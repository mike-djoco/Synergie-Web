<?php
    if (isset($_GET['login'])) {
        $db = mysqli_connect("localhost","djoco", "djoco", "djoco");

        $login = htmlentities($_GET['login']);
        $mail = htmlentities($_GET['mail']);
        $bday = htmlentities($_GET['bday']);
        $pswrd = htmlentities($_GET['pswrd']);
        //$pswrd = password_hash($pswrd, PASSWORD_ARGON2I);

        $sql = "INSERT INTO Utilisateur(login, mail, bday, paswrd) VALUES('$login', '$mail', '$bday', '$pswrd')";

        $req = mysqli_query($db, $sql);

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
        <title>Register</title>
    </head>

    <body>
        <header id="header">
            <nav>
                <img class="logo" src="img/logo.png"/>
                <p id="tittle">Inscription</p>
                <div class="link">
                    <a href="./index.php">HOME</a>
                    <a href="#">CONTACT</a>
                    <a href="./login.php">LOGIN</a>
                </div>
            </nav>
        </header>

        <div class="container">
            <?php 
                if (!isset(GET["login"])) {
                    echo "<form method='GET'>";
                        echo "<div>";
                            echo "<label for='login'>Identifiant : </label>";
                            echo "<input type='text' name='login'>";
                        echo "</div>";
            
                        echo "<div>";
                            echo "<label for='mail'>Mail : </label>";
                            echo "<input type='text' name='mail'>";
                        echo "</div>";

                        echo "<div>";
                            echo "<label for='bday'>Date de Naissance : </label>";
                            echo "<input type='date' name='bday'>";
                        echo "</div>";

                        echo "<div>";
                            echo "<label for='pswrd'>Mot de Passe : </label>";
                            echo "<input type='password' name='pswrd'>";
                        echo "</div>";
                        
                        echo "<div class='subm'>";
                            echo "<input type='submit' value='Suivant'>";
                        echo "</div>";
                    echo "</form>";
                }
            ?>
            <h1>Finaliser l'Inscription</h1>
            <form method="GET">
                <div>
                    <label for="prenom">Prenom : </label>
                    <input type="text" name="prenom">
                </div>

                <div>
                    <label for="nom">Nom : </label>
                    <input type="text" name="nom">
                </div>

                <div>
                    <label for="nom">Nom : </label>
                    <input type="text" name="nom">
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