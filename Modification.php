<?php
    // lors de la connection mettre le login dans un tableau post qu'on vas stocker dans une sessios pour 
    // pouvoir l'utiliser sur tous le site


    // il faut ajouter html_entities pour les donner afficher, mysqli_real_escape_string, 
    // et strip_tag pour les donné entrante

    // dans le schema de la base il faut change le role en type varchar car html ne renvoi que des string pas des int
    // (pour facilite les scripts php et ne pas avoir a convertir les strings en int)
    session_start();
    $db = mysqli_connect("https://dwarves.iut-fbleau.fr", "djoco", "djoco", "djoco");

    if(isset($_SESSION['user-auth'])){ // user-auth est crée au moment de la connection de l'utilisateur.

        // changer le mot de passe

        // on verifie que que toute les informations necessaire sont entrer et que l'utilisateur a bien
        // confirmer les mots de passe
        if(isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['ancienMDP']) && isset($_POST['password']) === isset($_POST['password2'])){
            
            // recupere le mot de passe pour verifier que la personne qui change le mot de passe 
            // est bien l'utilisateur connecté
            $sql="SELECT password FROM Utilisateur WHERE login={$_SESSION['login']}";  
            $req=mysqli_query($db, $sql);
            $res=mysqli_fetch_assoc($req);

            // si l'utilisateur a entrer le bon ancien mot de passe alors on met a jour le mot de passe
            if(password_verify($_POST['ancienMDP'], $res['password'])){
                $sql="UPDATE Utilisateur SET password={$_POST['password']} WHERE login={$_SESSION['login']}";
                if(mysqli_query($db, $sql)){
                    header("Location: index.php");
                }else{
                    die("Erreur: $sql");
                }
            }
            
        }

        // changer le mail
        if(isset($_POST['mail']) && isset($_Post['ancienMail']) && isset($_POST['mail2']) && isset($_POST['mail']) === isset($_POST['mail2'])){

            // recuper l'ancien mail et comparer avec ce qu'a entrer l'utilisateur.
            $sql = "SELECT mail FROM Utilisateur WHERE login={$_SESSION['login']}";
            $req = mysqli_query($db, $sql);
            $res = mysqli_fetch_assoc($req);

            // si le mot de passe entrer est le meme que stocker alors on change le mail
            if($res['mail'] === $_POST['ancienMail']){
                $sql="UPDATE Utilisateur SET mail={$_POST['mail']} WHERE login={$_SESSION['login']}";
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
        header("Location: user_login.php");
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="Modification.php" type="POST">
        <h2>Changer de mot de passe</h2>

        <label for="ancienMDP">Entrer ancien mot de passe</label>
        <input type="password" id="ancienMDP" name="ancienMDP" >

        <label for="password">Nouveau mot de passe</label>
        <input type="password" id="password" name="password" required>

        <label for="password2">Confirmer le mot de passe</label>
        <input type="password2" id="password2" name="password2" required>

        <input type="submit" value="Changer de mail">
    </form>

    <form action="Modification.php" type="POST">
        <h2>Changer de mail</h2>

        <label for="ancienMail">Entrer ancien mail</label>
        <input type="email" name="ancienMail" name="ancienMail">

        <label for="mail">Nouveau mail</label>
        <input type="email" id="mail" name="mail">

        <label for="mail2">Confirmer le mail</label>
        <input type="email" id="mail2" name="mail2">

        <input type="submit" value="Changer de mail">
    </form>

    <form action="Modification.php" method="POST" >
        <h2>Changer de rôle</h2>

        <label for="gestionnaire">Nouveau role</label>
        <input type="radio" name="role" id="gestionnaire" value="gestionnaire">

        <label for="adhérant">Adhérant</label>
        <input type="radio" name="role" id="adhérant" value="adhérant" >

        <label for="sympathisant">Sympathisant</label>
        <input type="radio" name="role" id="sympathisant" value="sympathisant">

        <input type="submit" value="Changer de rôle">
    </form>
</body>
</html>