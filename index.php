<?php
    session_start();
    include "./utils/requete.php";
    include "./utils/connecter.php";

    $db = _dbConnect();
    $resultat = _recupererEve($db);
    $id_eve=0;

    if (isset($_SESSION['user_auth'])) {
        if (isset($_POST["new-commentaire"])) {
            _commente($db, $_SESSION['login'], $_POST["idEve"], $_POST["new-commentaire"]);
            header("Location: ./index.php");
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
        <link rel="stylesheet" href="./css/index.css">
        <title>Acceuil</title>
    </head>
    
    <body style="--bck1:#C1C1C180;--hover:#C1C1C1BB;">
        <?php include "header.php" ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="./js/Evenement.js"></script>

        <div class="recherche-card">
            <div class="recherche-side">
                <div id="form-container"><!--
                    <form class="searchbar">
                        <input type="search" name="site-search" placeholder="Rechercher un Evenement ..."/>
                        <button  type="submit"><img src="./img/search.png" alt="Rechercher"></button >
                    </form>-->

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
                                    <a href="#" class="evenement-card" onclick="toggleSelect('.$i.')">
                                        <p class="card-name">'.$row["nom"].'</p>
                                        <p class="card-creator">'.$row["createur"].'</p>
                                        <p class="card-date">'.$row["dateEvenement"].'</p>
                                        <p class="card-info">'.$row["information"].'</p>
                                        <p class="card-id hidden">'.$row["id"].'</p>
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
            <article id="article-side">
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

                        
                        echo '
                            <div id="currentEvenement">
                                <p id="current-tittle"></p>
                                <p id="current-creator">Créer par : </p>
                                <p id="current-date-eve">Il aura lieux le : </p>
                                <p id="current-information"></p>
                                <p id="current-idEvent" class="hidden"></p>
                            </div>
                        ';
                    }else{
                        echo "<alert>Pas d'Evenement</alert>";
                    }
                ?>
                <div id="comment-container">
                    <?php
                        $com_res = _getCommentaire($db, $idEve);
                        if (mysqli_num_rows($com_res)>0) {
                            while ($rows = mysqli_fetch_assoc($com_res)) {
                                echo '
                                    <div class="comment-card">
                                        <p class="comment-name">'.$rows['loginUtilisateur'].'</p>
                                        <p class="comment-comentaire">'.$rows['comment'].'</p>
                                    </div>
                                ';
                            }
                        }
                    ?>

                    <form method="POST">
                        <input type="text" name="new-commentaire" id="new-commentaire" placeholder='Entre votre commentaire' required autofocus>
                        <?php
                        echo '<input type="hidden" id="idEve" name="idEve" value="">';
                        ?>
                        <button type="submit">Envoyer le Commentaire</button>
                    </form>
                </div>
            </article>
        </div>
    </body>
</html>