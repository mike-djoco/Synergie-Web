<?php
    session_start();
    include "./utils/requete.php";
    include "./utils/connecter.php";

    $db = _dbConnect();
    $resultat = _recupererEve($db);
?>

<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/globale.css">
        <link rel="stylesheet" href="./css/index.css">
        <title>Acceuil</title>
    </head>
    
    <body style="--bck1:#C1C1C180;--hover:#C1C1C1BB;">
        <?php include "header.php" ?>

        <div class="recherche-card">
            <div class="recherche-side">
                <div id="form-container">
                    <form id="recherche-form" method="POST">
                        <div class="radio-container">
                            <input type="radio" name="trier" value="creator">
                            <input type="trxt" name="creator" placeholder="Nom du Createur">
                        </div>

                        <div class="radio-container">
                            <input type="radio" name="trier" value="date">
                            <input type="date" name="date">
                        </div>

                        <div class="radio-container">
                            <input type="radio" name="trier" value="partmoins">
                            <label for="gestionnaire">Paricipant Croissant</label>
                        </div>

                        <div class="radio-container">
                            <input type="radio" name="trier" value="partplus">
                            <label for="partplus">Paricipant Decroissant</label>
                        </div>
                    </form>
                </div>
                <?php
                    if (isset($_POST["trier"])){
                        if ($_POST['trier'] == "date") {
                            if (isset($_POST['date']) && _verifDate($db, $_POST['date'])) {
                                $resultat = _recupererEveByDate($db, $_POST['date']);
                            }
                        }else if ($_POST['trier'] == "partmoins") {
                            $resultat = _recupererEveOrderPartASC($db);
                        }else if ($_POST['trier'] == "partplus") {
                            $resultat = _recupererEveOrderPartDESC($db);
                        }else{
                            $resultat = _recupererEve($db);
                        }
                    }else{
                        $resultat = _recupererEve($db);
                    }
                    if (mysqli_num_rows($resultat)>0) {
                        $i=0;
                        while ($row = mysqli_fetch_assoc($resultat)) {
                            echo '
                                <a class="evenement-card selected" onclick"">
                                    <p class="card-name">'.$row["nom"].'</p>
                                    <p class="card-creator">'.$row["createur"].'</p>
                                    <p class="card-date">'.$row["dateEvenement"].'</p>
                                    <p class="card-participant">'.$row["nbParticipant"].'</p>
                                </a>
                            ';
                            $i++;
                        }
                    }else{
                        echo "<alert>Pas de Ligne</alert>";
                    }
                ?>
            </div>
            <article class="article-side">
                <?php
                    if (mysqli_num_rows($resultat)>0) {
                        $row = mysqli_fetch_assoc($resultat);
                        echo '
                            <p id="current-tittle">'.$row["nom"].'</p>
                            <p id="current-creator">'.$row["createur"].'</p>
                            <p id="current-date-eve">'.$row["dateEvenement"].'</p>
                            <p id="current-information">'.$row["information"].'</p>
                        ';
                    }else{
                        echo "<alert>Pas de Ligne</alert>";
                    }
                ?>
            </article>
        </div>
    </body>
</html>