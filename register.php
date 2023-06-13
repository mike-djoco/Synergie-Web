<?php
    session_start();

    if (isset($_POST['prenom'])) {

        $_SESSION['prenom'] = htmlentities($_POST['prenom']);
        $_SESSION['nom'] = htmlentities($_POST['nom']);
        $_SESSION['bday'] = htmlentities($_POST['bday']);
    }
    
    if (isset($_POST['login'])) {
        $db = mysqli_connect("dwarves.iut-fbleau.fr","djoco", "djoco", "djoco");

        $prenom = $_SESSION['prenom'];
        $nom = $_SESSION['nom'];
        $bday = $_SESSION['bday'];
        $login = htmlentities($_POST['login']);
        $mail = htmlentities($_POST['mail']);
        $pswrd = htmlentities($_POST['pswrd']);

        //$pswrd = password_hash($pswrd, PASSWORD_ARGON2I);

        $sqlLogin = "SELECT login FROM Utilisateur WHERE login = '$login'";
        $resLogin = mysqli_query($db, $sqlLogin);
        $sqlMail = "SELECT mail FROM Utilisateur WHERE login = '$mail'";
        $resMail = mysqli_query($db, $sqlMail);
        if (mysqli_num_rows($resLogin) > 0) {
            echo "alert('Identifiant deja utilisé')";
        }else if (mysqli_num_rows($resMail) > 0) {
            echo "alert('Mail deja utilisé')";
        }else if (strlen($pswrd)<8) {
            echo "alert('MDP trop court');";
        }else if (strlen($pswrd)>=8) {
            $nbMaj=0;
            $nbChif=0;
            $nbCharS=0;
            for ($i=0; $i < strlen($pswrd); $i++) { 
                $char = substr($pswrd, i, 1);
                if ($char=='0' || $char=='1' || $char=='2' || $char=='3' || $char=='4' || $char=='5' || $char=='6' || $char=='7' || $char=='8' || $char=='9') {
                    $nbChif++;
                }else if ($char=='.' || $char=='!' || $char=='?' || $char=='€' || $char=='*') {
                    $nbCharS++;
                }else if ($char=='.' || $char=='!' || $char=='?' || $char=='€' || $char=='*') {
                    $nbCharS++;
                }
            }
        }else{
            $sql = "INSERT INTO Utilisateur(login, mail, paswrd, prenom, nom, bday) VALUES('$login', '$mail', '$pswrd', '$prenom', '$nom', '$bday')";
            mysqli_query($db, $sql);
            mysqli_close($db);
            header("location: ./index.php");
        }
        echo "alert('Incription impossible')";
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
                if (!isset($_POST["prenom"])) {
                    echo "<form method='POST'>";
                        echo "<div>";
                            echo "<label for='prenom'>Prenom : </label>";
                            echo "<input type='text' name='prenom'>";
                        echo "</div>";

                        echo "<div>";
                            echo "<label for='nom'>Nom : </label>";
                            echo "<input type='text' name='nom'>";
                        echo "</div>";

                        echo "<div>";
                            echo "<label for='bday'>Date de Naissance : </label>";
                            echo "<input type='date' name='bday'>";
                        echo "</div>";
                        
                        echo "<div class='subm'>";
                            echo "<input type='submit' value='Suivant'>";
                        echo "</div>";
                    echo "</form>";
                }

                if (isset($_POST["prenom"])) {
                    echo "<form method='POST'>";
                        echo "<div>";
                            echo "<label for='login'>Identifiant : </label>";
                            echo "<input type='text' name='login'>";
                        echo "</div>";
            
                        echo "<div>";
                            echo "<label for='mail'>Mail : </label>";
                            echo "<input type='text' name='mail'>";
                        echo "</div>";

                        echo "<div>";
                            echo "<label for='pswrd'>Mot de Passe : </label>";
                            echo "<input type='password' name='pswrd'>";
                        echo "</div>";
                        
                        echo "<div class='subm'>";
                            echo "<input type='submit' value='Finaliser '>";
                        echo "</div>";
                    echo "</form>";
                }
            ?>
        </div>
    </body>
</html>
