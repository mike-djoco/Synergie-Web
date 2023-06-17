<?php
session_start();
include "utils/connecter.php";
include "utils/MotDePasse.php";
include "utils/requete.php";
$step1 = false;

if (isset($_POST['prenom'])) {
    $prenom = htmlentities($_POST['prenom']);
    $nom = htmlentities($_POST['nom']);
    $bday = htmlentities($_POST['bday']);
    if (strlen($prenom) >= 2 && strlen($nom) >= 2 && strlen($bday) != "") {
        $step1 = true;
    }
} else {
    $prenom;
    $nom;
    $bday;
}


if (isset($_POST['login'])) {
    $db = _dbConnect();
    $login = htmlentities($_POST['login']);
    $mail = htmlentities($_POST['mail']);
    $pswrd = htmlentities($_POST['pswrd']);
    $pswrd = password_hash($pswrd, PASSWORD_DEFAULT);
    $prenom = $_POST['prenom'];

    $sqlLogin = "SELECT login FROM Utilisateur WHERE login = '$login'";
    $resLogin = mysqli_query($db, $sqlLogin);
    $sqlMail = "SELECT mail FROM Utilisateur WHERE mail = '$mail'";
    $resMail = mysqli_query($db, $sqlMail);
    if (mysqli_num_rows($resLogin) > 0) {
        echo "alert('Identifiant deja utilisé')";
    } else if (mysqli_num_rows($resMail) > 0) {
        echo "alert('Mail deja utilisé')";
    } elseif (_verificationMDP($db, $pswrd)) {
        if (_creerUtilisateur($db, $login, $mail, $pswrd, $prenom, $nom, $bday, "sympathisant")) {
            $_SESSION['user_auth'] = true;
            $_SESSION['login'] = $login;
            $_SESSION['role'] = $role;
            $cle = "MaSuperCleSecreteQueTuNeTrouevraPas";
            $cleHash = hash_hmac("sha256", $cle, "MaCle");
            $_SESSION['cle'] = $cleHash;
            header("Location: ./account.php");
        }
    } else {
        header("Location: ./register.php");
        echo "<alert>('Incription impossible')</alert>";
        mysqli_close($db);
    }
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
    <title>Register</title>
</head>

<body>
    <header id="header">
        <nav>
            <a href="./index.php"><img src="./img/logo.png" /></a>
            <div class="navivation">
                <a class="nav-links" href="./login.php">Login</a>
                <a class="nav-links" href="./register.php">Register</a>
                <a href="./modification.php"><img src="./img/account.png" /></a>
            </div>
        </nav>
    </header>


    <div class="login-card-container">
        <div class="login-card">
            <div class="login-card-logo">
                <img src="./img/logo.png" alt="logo">
            </div>

            <div class="login-head">
                <h1>Inscripion</h1>
            </div>
            <?php
            if ($step1 == false) {
                echo "<form class='login-form' method='POST'>";
                echo "<div class='form-line'>";
                echo "<span class='form-item-icon'></span>";
                echo "<input type='text' name='prenom' placeholder='Entrer votre Prenom' required autofocus>";
                echo "</div>";

                echo "<div class='form-line'>";
                echo "<span class='form-item-icon'></span>";
                echo "<input type='text' name='nom' placeholder='Entrer votre Nom' required>";
                echo "</div>";

                echo "<div class='form-line'>";
                echo "<span class='form-item-icon'></span>";
                echo "<input type='date' name='bday' required>";
                echo "</div>";

                echo "<button type='submit'>Etape Suivante</button>";
                echo "</form>";
            }

            if ($step1 == true) {
                echo "<form class='login-form' method='POST'>";
                echo "<div class='form-line'>";
                echo "<span class='form-item-icon'></span>";
                echo "<input type='text' name='login' placeholder='Entrer un Identifiant' required autofocus>";
                echo "</div>";

                echo "<div class='form-line'>";
                echo "<span class='form-item-icon'></span>";
                echo "<input type='text' name='mail' placeholder='Entrer une Email' required>";
                echo "</div>";

                echo "<div class='form-line'>";
                echo "<span class='form-item-icon'></span>";
                echo "<input type='password' name='pswrd' placeholder='Entrer un Mot de Passe' required>";
                echo "</div>";
                echo "<p style='font-size: xx-small; align-self:center;'>minimun 8 caractere, une majuscule, un chiffre, un caractere speciale</p>";

                echo ' <input type="hidden" name="nom" value="' . $nom . '">';
                echo ' <input type="hidden" name="prenom" value="' . $prenom . '">';
                echo ' <input type="hidden" name="bday" value="' . $bday . '">';

                echo "<button type='submit'>Finalisée l'Incription</button>";
                echo "</form>";
            }
            ?>
            <div class="login-footer">
                Si vous avez deja un compte ? <a href="./login.php">Connecter vous</a>
            </div>
        </div>
    </div>
</body>

</html>