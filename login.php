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
                    //echo "<script>alert('connection reussi')</script>";
                    $sql = "SELECT role FROM Utilisateur WHERE login = '$login'";
                    $res = mysqli_query($db, $sql);
                    $row = mysqli_fetch_assoc($res);
                    $Srole = $row['role'];
                    session_start();
                    $_SESSION['user_auth'] = true;
                    $_SESSION['login'] = $Slogin;
                    $_SESSION['role'] = $Srole;
                    header("Location = Modification.php");
                }
            }
        }

        mysqli_close($db);
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/globale.css">
        <link rel="stylesheet" href="./css/register.css">
		<link rel="icon" type="image/png" sizes="16x16" href="./img/logo.png">
        <title>Login</title>
    </head>

    <body>
        <!-- <header id="header">
            <nav>
                <a href="./index.php"><img src="./img/logo.png"/></a>
                <div class="navivation">
                    <a class="nav-links" href="./login.php">Login</a>
                    <a class="nav-links" href="./register.php">Register</a>
                    <a href="./modification.php"><img src="./img/account.png"/></a>
                </div>
            </nav>
        </header> -->
        <?php include "header.php" ?>

            
        <div class="login-card-container">
            <div class="login-card">
                <div class="login-card-logo">
                    <img src="./img/logo.png" alt="logo">
                </div>

                <div class="login-head">
                    <h1>Connection</h1>
                </div>

                <form class='login-form' method='POST'>
                    <div class='form-line'>
                        <span class='form-item-icon'></span>
                        <input type='text' name='login' placeholder='Entrer votre Identifiant' required autofocus>
                    </div>

                    <div class='form-line'>
                        <span class='form-item-icon'></span>
                        <input type='password' name='pswrd' placeholder='Entrer votre Mot de Passe' required>
                    </div>
                    
                    <button type='submit'>Se Connecté</button>

                </form>

                <div class="login-footer">
                    Vous n'avez pas de compte ? <a href="./register.php">Inscrivez vous</a>
                </div>
            </div>
        </div>
<!--
        <a id="top" href="#header"><img src="/img/fleche.png" /></a>
-->
    </body>
</html>