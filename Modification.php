<?php
// lors de la connection mettre le login dans un tableau post qu'on vas stocker dans une sessios pour 
// pouvoir l'utiliser sur tous le site

include "./utils/requete.php";
// il faut ajouter html_entities pour les donner afficher, mysqli_real_escape_string, 
// et strip_tag pour les donné entrante
// ajouter une session pour connaitre le role de l'utilisateur
//ajouter la verification lorsque l'utilisateur confirme le mot de passe ou le mail

// dans le schema de la base il faut change le role en type varchar car html ne renvoi que des string pas des int
// (pour facilite les scripts php et ne pas avoir a convertir les strings en int)
session_start();
$db = mysqli_connect("dwarves.iut-fbleau.fr", "djoco", "djoco", "djoco");

if (isset($_SESSION['user_auth'])) { // user_auth est crée au moment de la connection de l'utilisateur.

    if (isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['ancienMDP'])) {
        if ($_POST['password'] === $_POST['password2']) {
            _changerMPD($db, $_POST['ancienMDP'], $_POST['password'], "modification.php");
        } else {
            echo "les mots de passe ne correspondent pas";
        }
    }

    if (isset($_POST['mail']) && isset($_POST['ancienMail']) && isset($_POST['mail2'])) {

        if ($_POST['mail'] === $_POST['mail2']) {
            _changerMail($db, $_POST['ancienMail'], $_POST['mail'], "modification.php");
        } else {
            echo "Les mails ne correspondent pas";
        }
    }

    if (isset($_POST['role'])) {
        _changerRole($db, $_POST['role'], "modification.php");
    }

} else {
    header("Location: login.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/logo.png">
    <link rel="stylesheet" href="./css/globale.css">
    <link rel="stylesheet" href="./css/modification.css">

    <title>Modification</title>
</head>

<body style="--bck1:#C1C1C180;--hover:#C1C1C1BB;">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="./js/modification.js"></script>

    <?php include "header.php"; ?>
    <div class="modification-card">
        <nav>
            <a href="#" onclick="toggleInfo(0)" class="alink current">Information</a>
            <a href="#" onclick="toggleInfo(1)" class="alink">Mot de Passe</a>
            <a href="#" onclick="toggleInfo(2)" class="alink">Mail</a>
            <a href="#" onclick="toggleInfo(3)" class="alink">Role</a>
        </nav>

        <div class="form-container">
            <form action="Modification.php" method="POST" class="modification-form current">
                <h2>Information du Compte</h2>

                <input type="text" id="nom" name="nom" placeholder="Entrer votre Nom" required autofocus>

                <input type="text" id="prenom" name="prenom" placeholder="Entrer votre Prenom" required>

                <input type="date" id="bday" name="bday" placeholder="Entrer votre Date de Naissance" required>

                <button type="submit">Modifier mes Informations</button>
            </form>

            <form action="Modification.php" method="POST" class="modification-form">
                <h2>Changer de mot de passe</h2>

                <input type="password" id="ancienMDP" name="ancienMDP" placeholder="Entrer ancien mot de passe" required autofocus>

                <input type="password" id="password" name="password" placeholder="Nouveau mot de passe" required>

                <input type="password" id="password2" name="password2" placeholder="Confirmer le mot de passe" required>

                <button type="submit">Effectué le changement</button>
            </form>

            <form action="Modification.php" method="POST" class="modification-form">
                <h2>Changer de mail</h2>

                <input type="email" name="ancienMail" name="ancienMail" placeholder="Confirmer le mot de passe" required autofocus>

                <input type="email" id="mail" name="mail" placeholder="Nouveau mail" required>

                <input type="email" id="mail2" name="mail2" placeholder="Confirmer le mail" required>

                <button type="submit">Effectué le changement</button>
            </form>


            <?php
            //en fonction du role de l'utilisateur on affiche les deux autre role possible
            if (isset($_SESSION['user_auth'])) {
                $role = $_SESSION['role'];
                if ($role === "gestionnaire") {
                    echo '
                        <form action="Modification.php" method="POST" class="modification-form">
                            <h2>Changer de rôle</h2>
                            <div class="radio-container">
                                <input type="radio" name="role" id="adhérant" value="adhérant" >
                                <label for="adhérant">Adhérant</label>
                            </div>

                            <div class="radio-container">
                                <input type="radio" name="role" id="sympathisant" value="sympathisant">
                                <label for="sympathisant">Sympathisant</label>
                            </div>

                            <button type="submit">Effectué le changement</button>
                        </form>
                        ';
                } else if ($role === "adhérant") {
                    echo '
                        <form action="Modification.php" method="POST" class="modification-form">
                            <h2>Changer de rôle</h2>
                            <div class="radio-container">
                                <input type="radio" name="role" id="gestionnaire" value="gestionnaire">
                                <label for="gestionnaire">gestionnaire</label>
                            </div>

                            <div class="radio-container">
                                <input type="radio" name="role" id="sympathisant" value="sympathisant">
                                <label for="sympathisant">Sympathisant</label>
                            </div>

                            <button type="submit">Effectué le changement</button>
                        </form>
                        ';
                } else if ($role === "sympathisant") {
                    echo '
                        <form action="Modification.php" method="POST" class="modification-form">
                            <h2>Changer de rôle</h2>
                            <div class="radio-container">
                                <input type="radio" name="role" id="gestionnaire" value="gestionnaire">
                                <label for="gestionnaire">gestionnaire</label>
                            </div>
                            <div class="radio-container">
                                    <input type="radio" name="role" id="adhérant" value="adhérant" >
                                    <label for="adhérant">Adhérant</label>
                            </div>
                            <button type="submit">Effectué le changement</button>
                        </form>
                        ';
                } else {
                    //modifie pour que lors de l'incription il est un role par defaut de sympathisant dans
                    // un champ caché
            
                    echo '
                    <form action="Modification.php" method="POST" class="modification-form">
                        <h2>Changer de rôle</h2>

                        <div class="radio-container">
                            <input type="radio" name="role" id="gestionnaire" value="gestionnaire">
                            <label for="gestionnaire">gestionnaire</label>
                        </div>

                        <div class="radio-container">
                            <input type="radio" name="role" id="adhérant" value="adhérant">
                            <label for="adhérant">Adhérant</label>
                        </div>

                        <div class="radio-container">
                            <input type="radio" name="role" id="sympathisant" value="sympathisant">
                            <label for="sympathisant">Sympathisant</label>
                        </div>

                        <button type="submit">Effectué le changement</button>
                    </form>
                    ';
                }
            }
            ?>
        </div>
    </div>

    <?php include "footer.php"; ?>