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
                    <form class="searchbar">
                        <input type="search" name="site-search" placeholder="Rechercher un Evenement ..."/>
                        <button  type="submit"><img src="./img/search.png" alt="Rechercher"></button >
                    </form>

                    <div class="sortby">
                        <p>Trier par : </p>
                        <span class="sort-list">
                            <a href="index.php?sort=pluspart">Le + de participant</a>
                            <a href="index.php?sort=moinspart">Le - de participant</a>
                            <a href="index.php?sort=new">Nouveauté</a>
                        </span>
                    </div>
                </div>
                <div id="recherche-container">
                    <?php
                        if (isset($_GET["sort"])){
                            if ($_GET['sort'] == "date") {
                                if (isset($_GET['sort']) && _verifDate($db, $_GET['sort'])) {
                                    $resultat = _recupererEveByDate($db, $_GET['sort']);
                                }
                            }else if ($_GET['sort'] == "moinspart") {
                                $resultat = _recupererEveOrderPartASC($db);
                            }else if ($_GET['sort'] == "pluspart") {
                                $resultat = _recupererEveOrderPartDESC($db);
                            }else if ($_GET['sort'] == "new"){
                                $resultat = _recupererEveOrderData($db);
                            }
                        }else{
                            $resultat = _recupererEve($db);
                        }
                        if (mysqli_num_rows($resultat)>0) {
                            $i=0;
                            while ($row = mysqli_fetch_assoc($resultat)) {
                                echo '
                                    <a class="evenement-card" onclick"toggleSelect('.$i.')">
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
            </div>
            <article class="article-side">
                <?php
                    if (mysqli_num_rows($resultat)>0) {
                        if (isset($_GET["sort"])){
                            if ($_GET['sort'] == "date") {
                                if (isset($_GET['sort']) && _verifDate($db, $_GET['sort'])) {
                                    $resultat = _recupererEveByDate($db, $_GET['sort']);
                                }
                            }else if ($_GET['sort'] == "moinspart") {
                                $resultat = _recupererEveOrderPartASC($db);
                            }else if ($_GET['sort'] == "pluspart") {
                                $resultat = _recupererEveOrderPartDESC($db);
                            }else if ($_GET['sort'] == "new"){
                                $resultat = _recupererEveOrderData($db);
                            }
                        }else{
                            $resultat = _recupererEve($db);
                        }

                        while ($row = mysqli_fetch_assoc($resultat)) {
                            if (condition) {
                            }
                            echo '
                                <p id="current-tittle">'.$row["nom"].'</p>
                                <p id="current-creator">'.$row["createur"].'</p>
                                <p id="current-date-eve">'.$row["dateEvenement"].'</p>
                                <p id="current-information">'.$row["information"].'</p>
                            ';
                        }
                    }else{
                        echo "<alert>Pas d'Evenement</alert>";
                    }
                ?>
            </article>
        </div>
    </body>
</html>