<?php
function _changerMPD(mysqli $db, string $oldMpd, string $newMdp, string $redirect)
{
    // recupere le mot de passe pour verifier que la personne qui change le mot de passe 
    // est bien l'utilisateur connecté
    $oldMpd = mysqli_real_escape_string($db, $oldMpd);
    $newMdp = mysqli_real_escape_string($db, $newMdp);
    $login = $_SESSION['login'];
    $sql = "SELECT paswrd FROM Utilisateur WHERE login = '$login'";
    $req = mysqli_query($db, $sql);
    $res = mysqli_fetch_assoc($req); // mot de passe stocker

    // si l'utilisateur a entrer le bon ancien mot de passe alors on met a jour le mot de passe
    if ($oldMpd == $res['paswrd']) { 
        $stmt = mysqli_prepare($db, "UPDATE Utilisateur SET paswrd=? WHERE login = '$login'");
        mysqli_stmt_bind_param($stmt, "s", $newMdp);
        if (mysqli_execute($stmt)) {
            header("Location: " . $redirect);
        } else {
            die("Erreur: $sql");
        }
    } else {
        echo "Impossible de changer le mot de passe";
    }
}

function _changerMail(mysqli $db, string $oldMail, string $newMail, string $redirect)
{
    // recuper l'ancien mail et comparer avec ce qu'a entrer l'utilisateur.
    $oldMail = mysqli_real_escape_string($db, $oldMail);
    $newMail = mysqli_real_escape_string($db, $newMail);
    $login = $_SESSION['login'];
    $sql = "SELECT mail FROM Utilisateur WHERE login='$login'";
    $req = mysqli_query($db, $sql);
    $res = mysqli_fetch_assoc($req);

    // si le mot de passe entrer est le meme que stocker alors on change le mail
    if ($res['mail'] === $oldMail) {
        $stmt = mysqli_prepare($db, "UPDATE Utilisateur SET mail = '?' WHERE login = '$login'");
        mysqli_stmt_bind_param($stmt, "s", $newMail);
        if (mysqli_execute($stmt)) {
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
    $role = mysqli_real_escape_string($db, $role);
    $stmt = mysqli_prepare($db, "UPDATE Utilisateur SET role='?' WHERE login='$login'");
    mysqli_stmt_bind_param($stmt, "s", $role);
    if (mysqli_execute($stmt)) {
        $_SESSION['role'] = $role;
        header("Location: " . $redirect);
    }
}

function _changerNom(mysqli $db, string $nom, string $redirect)
{
    $nom = mysqli_real_escape_string($db, $nom);
    $login = $_SESSION['login'];
    $stmt = mysqli_prepare($db, "UPDATE Utilisateur SET nom='?' WHERE login = '$login' ");
    mysqli_stmt_bind_param($stmt, "s", $nom);
    if (mysqli_execute($stmt)) {
        $_SESSION['nom'] = $nom;
        header("Location: " . $redirect);
    } else {
        echo "Impossible de changer le nom";
    }
}

function _changerPrenom(mysqli $db, string $prenom, string $redirect)
{
    $prenom = mysqli_real_escape_string($db, $prenom);
    $login = $_SESSION['login'];
    $stmt = mysqli_prepare($db, "UPDATE Utilisateur SET prenom = '?' WHERE login = '$login'");
    mysqli_stmt_bind_param($stmt, "s", $prenom);
    if (mysqli_execute($stmt)) {
        $_SESSION['prenom'] = $prenom;
        header("Location: " . $redirect);
    } else {
        echo "Impossible de changer de prenom";
    }

}

function _creerUtilisateur(mysqli $db, string $login, string $mail, string $pswrd, string $prenom, string $nom, string $bday)
{
    $sql = "INSERT INTO Utilisateur(login, mail, paswrd, prenom, nom, bday) VALUES('$login', '$mail', '$pswrd', '$prenom', '$nom', '$bday')";
    mysqli_query($db, $sql);
    header("Location: ./index.php");
}

function _recupperereInfo(mysqli $db){
    $login = $_SESSION['login'];
    $sql = mysqli_prepare($db, "SELECT * FROM Utilisateur WHERE login = $login");
    $res =  mysqli_query($db, $sql);
    if($row =  mysqli_fetch_assoc($res)){
        return $row;
    }
    
}

function _ajouterEvenement(mysqli $db, string $nomEv, $date, string $information)
{
    $nomEv = mysqli_real_escape_string($db, $nomEv);
    $information = mysqli_real_escape_string($db, $information);
    $info = _recupperereInfo($db); 

    $stmt = mysqli_prepare($db, "INSERT INTO Evenement (nom, createur, dateEvenement, information )VALUE (?, ?, ?)");

}
// cree une cle et la hasher avec hashmac et la mettre dans un session champ cacher

// faire des requete preparer avec mysqli prepare et mysqli_stmt_bind_param($stmt, "s", $city)

// html special car pour afficher des ino-formation venu de html
// filter input
// nl2br
?>