<?php
    // lors de la connection mettre le login dans un tableau post qu'on vas stocker dans une sessios pour 
    // pouvoir l'utiliser sur tous le site


    // il faut ajouter html_entities pour les donner afficher, mysqli_real_escape_string, 
    // et strip_tag pour les donné entrante
    // ajouter une session pour connaitre le role de l'utilisateur

    // dans le schema de la base il faut change le role en type varchar car html ne renvoi que des string pas des int
    // (pour facilite les scripts php et ne pas avoir a convertir les strings en int)
    session_start();
    $db = mysqli_connect("dwarves.iut-fbleau.fr", "djoco", "djoco", "djoco");

    if(isset($_SESSION['user_auth'])){ // user_auth est crée au moment de la connection de l'utilisateur.

        // changer le mot de passe

        // on verifie que que toute les informations necessaire sont entrer et que l'utilisateur a bien
        // confirmer les mots de passe
        if(isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['ancienMDP'])){
            
            // recupere le mot de passe pour verifier que la personne qui change le mot de passe 
            // est bien l'utilisateur connecté
            $login = $_SESSION['login'];
            $sql="SELECT paswrd FROM Utilisateur WHERE login = '$login'";  
            $req=mysqli_query($db, $sql);
            $res=mysqli_fetch_assoc($req);

            // si l'utilisateur a entrer le bon ancien mot de passe alors on met a jour le mot de passe
            if($_POST['ancienMDP'] == $res['paswrd']){ //password_verify($_POST['ancienMDP'], $res['password'])
                $mdp = $_POST['password'];
                $sql="UPDATE Utilisateur SET paswrd='$mdp' WHERE login = '$login'";
                if(mysqli_query($db, $sql)){
                    header("Location: index.php");
                }else{
                    die("Erreur: $sql");
                }
            }
            
        }

        // changer le mail
        if(isset($_POST['mail']) && isset($_POST['ancienMail']) && isset($_POST['mail2'])){

            // recuper l'ancien mail et comparer avec ce qu'a entrer l'utilisateur.
            $login = $_SESSION['login'];
            $sql = "SELECT mail FROM Utilisateur WHERE login='$login'";
            $req = mysqli_query($db, $sql);
            $res = mysqli_fetch_assoc($req);

            // si le mot de passe entrer est le meme que stocker alors on change le mail
            if($res['mail'] === $_POST['ancienMail']){
                $mail = $_POST['mail'];
                $sql="UPDATE Utilisateur SET mail = '$mail' WHERE login = '$login'";
            if(mysqli_query($db, $sql)){
                header("Location: index.php");
            }else{
                die("Erreur: $sql");
            }
            }
        }

        // changer le role
        if(isset($_POST['role']) && isset($_POST['role2']) && isset($_POST['role']) === isset($_POST['role2'])){
            $sql="UPDATE Utilisateur SET role={$_POST['role']} WHERE login={$_SESSION['login']}";
            if(mysqli_query($db, $sql)){
                header("Location: index.php");
            }else{
                die("Erreur: $sql");
            }
        }
       
    }else{
        header("Location: login.php");
    }


?>

    <?php include "header.php"; ?>

    <form action="Modification.php" method="POST">
        <h2>Changer de mot de passe</h2>

        <label for="ancienMDP">Entrer ancien mot de passe</label>
        <input type="password" id="ancienMDP" name="ancienMDP" >

        <label for="password">Nouveau mot de passe</label>
        <input type="password" id="password" name="password" required>

        <label for="password2">Confirmer le mot de passe</label>
        <input type="password" id="password2" name="password2" required>

        <input type="submit" value="Changer de mpd">
    </form>

    <form action="Modification.php" method="POST">
        <h2>Changer de mail</h2>

        <label for="ancienMail">Entrer ancien mail</label>
        <input type="email" name="ancienMail" name="ancienMail">

        <label for="mail">Nouveau mail</label>
        <input type="email" id="mail" name="mail">

        <label for="mail2">Confirmer le mail</label>
        <input type="email" id="mail2" name="mail2">

        <input type="submit" value="Changer de mail">
    </form>


    <?php
        //en fonction du role de l'utilisateur on affiche les deux autre role possible
        if(isset($_SESSION['user_auth'])){
            $role = $_SESSION['role'];
            if($role === "gestionnaire"){
                echo '
                    <input type="radio" name="role" id="adhérant" value="adhérant" >
                    <label for="adhérant">Adhérant</label>
                    
                    <input type="radio" name="role" id="sympathisant" value="sympathisant">
                    <label for="sympathisant">Sympathisant</label>
                ';
            }else if($role === "adhérant"){
                echo '
                    <input type="radio" name="role" id="gestionnaire" value="gestionnaire">
                    <label for="gestionnaire">gestionnaire</label>

                    <input type="radio" name="role" id="sympathisant" value="sympathisant">
                    <label for="sympathisant">Sympathisant</label>
                ';
            }else if($role === "sympathisant"){
                echo '
                    <input type="radio" name="role" id="gestionnaire" value="gestionnaire">
                    <label for="gestionnaire">gestionnaire</label>
                
                    <input type="radio" name="role" id="adhérant" value="adhérant" >
                    <label for="adhérant">Adhérant</label>
                ';
            }
        }
    ?>

    <form action="Modification.php" method="POST" >
        <h2>Changer de rôle</h2>

        <input type="radio" name="role" id="gestionnaire" value="gestionnaire">
        <label for="gestionnaire">gestionnaire</label>
       
        <input type="radio" name="role" id="adhérant" value="adhérant" >
        <label for="adhérant">Adhérant</label>
        
        <input type="radio" name="role" id="sympathisant" value="sympathisant">
        <label for="sympathisant">Sympathisant</label>

        <input type="submit" value="Changer de rôle">
    </form>
    <a href="./index.php">Home Page<a>

    <?php include "footer.php"; ?>