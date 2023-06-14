<?php
function _changerMPD(mysqli $db, string $oldMpd, string $newMdp, string $redirect)
{
    // recupere le mot de passe pour verifier que la personne qui change le mot de passe 
    // est bien l'utilisateur connecté
    $login = $_SESSION['login'];
    $sql = "SELECT paswrd FROM Utilisateur WHERE login = '$login'";
    $req = mysqli_query($db, $sql);
    $res = mysqli_fetch_assoc($req); // mot de passe stocker

    // si l'utilisateur a entrer le bon ancien mot de passe alors on met a jour le mot de passe
    if ($oldMpd == $res['paswrd']) { //password_verify($_POST['ancienMDP'], $res['password'])
        $sql = "UPDATE Utilisateur SET paswrd='$newMdp' WHERE login = '$login'";
        if (mysqli_query($db, $sql)) {
            header("Location: " . $redirect);
        } else {
            die("Erreur: $sql");
        }
    } else {
        echo $_POST['password'];
        echo $_POST['password2'];
        echo "Impossible de changer le mot de passe";
    }
}

function _changerMail(mysqli $db, string $oldMail, string $newMail, string $redirect)
{
    // recuper l'ancien mail et comparer avec ce qu'a entrer l'utilisateur.
    $login = $_SESSION['login'];
    $sql = "SELECT mail FROM Utilisateur WHERE login='$login'";
    $req = mysqli_query($db, $sql);
    $res = mysqli_fetch_assoc($req);

    // si le mot de passe entrer est le meme que stocker alors on change le mail
    if ($res['mail'] === $oldMail) {
        $sql = "UPDATE Utilisateur SET mail = '$newMail' WHERE login = '$login'";
        if (mysqli_query($db, $sql)) {
            header("Location: " . $redirect);
        } else {
            die("Erreur: $sql");
        }
    } else {
        echo "Impossible de changer le mail";
    }
}

function _changerRole(mysqli $db, string $role, string $redirect)
{
    $login = $_SESSION['login'];
    $sql = "UPDATE Utilisateur SET role='$role' WHERE login='$login'";
    if (mysqli_query($db, $sql)) {
        $_SESSION['role'] = $_POST["role"];
        header("Location: ".$redirect);
    } else {
        die("Erreur: $sql");
    }
}

function _changerNom(mysqli $db, string $nom, string $redirect)
{
    if (isset($POST['nom'])) {
        $login = $_SESSION['login'];
        $sql = "UPDATE Utilisateur SET nom='$nom' WHERE login = '$login' ";
        if (mysqli_query($db, $sql)) {
            $_SESSION['nom'] = $nom;
            header("Location: ".$redirect);
        } else {
            echo "Impossible de changer le nom";
        }
    }
}

function _changerPrenom(mysqli $db, string $prenom, string $redirect)
{
    if (isset($_POST['prenom'])) {
        $prenom = mysqli_real_escape_string($db, $prenom);
        $login = $_SESSION['login'];
        $sql = "UPDATE Utilisateur SET prenom = '$prenom' WHERE login = '$login'";
        if (mysqli_query($db, $sql)) {
            $_SESSION['prenom'] = $prenom;
            header("Location: ".$redirect);
        } else {
            echo "Impossible de changer de prenom";
        }

    }
}

function _creerUtilisateur(mysqli $db, string $login, string $mail, string $pswrd, string $prenom, string $nom, string $bday)
{
    $sql = "INSERT INTO Utilisateur(login, mail, paswrd, prenom, nom, bday) VALUES('$login', '$mail', '$pswrd', '$prenom', '$nom', '$bday')";
    mysqli_query($db, $sql);
    header("Location: ./index.php");
}

?>