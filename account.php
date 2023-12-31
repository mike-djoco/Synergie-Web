<?php

    include "./utils/requete.php";
    include "./utils/connecter.php";

    session_start();
    if (!isset($_SESSION['user_auth'])){
        header("Location: ./login.php");
    }else{
        $db = _dbConnect();
        $info = _recuppererInfo($db);
        $row = mysqli_fetch_assoc($info);
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
    <link rel="stylesheet" href="./css/account.css">

    <title>Account</title>
</head>

<body style="--bck1:#C1C1C180;--hover:#C1C1C1BB;">

    <?php include "header.php"; ?>

    <div class="account-card">
        <div class="information-container">
            <div class="account-name">
                <!--remplacer par le prenom et le nom en majiscule-->
                <?php echo "".$row['prenom']." " .$row['nom'] ?>
            </div>
            <div class="account-mail">
                <!--remplacer par le mail-->
                <?php echo $row['mail'] ?>
            </div>
            <div class="account-bday">
                <!--remplacer par la date de naissance-->
                <?php echo $row['bday'] ?>
            </div>
        </div>
        <button onclick="location.href='./Modification.php'">Modifier les informations</button>
        <button onclick="location.href='./newEvenement.php'">Creer un Evenement</button>
    </div>

    <?php include "footer.php"; ?>