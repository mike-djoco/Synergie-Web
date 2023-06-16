<?php

    include "./utils/requete.php";
    include "./utils/connecter.php";

    session_start();

    if (isset($_POST['nom'])) {
        $db = _dbConnect();

        $nom = htmlentities($_POST['nom']);
        $date = htmlentities($_POST['date']);
        $info = htmlentities($_POST['info']);
        $accreditation = htmlentities($_POST['accreditation']);

        _ajouterEvenement($db, $nom, $date, $info, $accreditation);
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
    <link rel="stylesheet" href="./css/newEvenement.css">

    <title>New Evenement</title>
</head>

<body style="--bck1:#C1C1C180;--hover:#C1C1C1BB;">

    <?php include "header.php"; ?>

    <div class="evenement-card">
        <form class="evenement-form" method="POST">
            <h1>Creer un Evenement</h1>
            <div class="form-line">
                <input type="text" name="nom" placeholder="Entrer le nom de l'Evenement" required autofocus>
            </div>

            <div class="form-line">
                <input type="date" name="date" required>
            </div>

            <div class="form-line">
                <input type="text" name="info" placeholder="Entrer un description pour l'Evenement" required autofocus>
            </div>

            <div class="radio-container">
                <input type="radio" name="accreditation" id="adhérant" value="adhérant" >
                <label for="adhérant">Adhérant</label>
            </div>

            <div class="radio-container">
                <input type="radio" name="accreditation" id="sympathisant" value="sympathisant">
                <label for="sympathisant">Sympathisant</label>
            </div>
            
            <button type="submit">Enregistrer l'Evenement</button>
        </form>
    </div>

    <?php include "footer.php"; ?>