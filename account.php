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
                Frederick CHOUX
            </div>
            <div class="account-mail">
                <!--remplacer par le mail-->
                fred.le.choux@mangue.martinique
            </div>
            <div class="account-bday">
                <!--remplacer par la date de naissance-->
                20/07/1901
            </div>
        </div>
        <button href="./Modification.php">Modifier les informations</button>
    </div>

    <?php include "footer.php"; ?>