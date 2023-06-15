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
        return false;
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
        $stmt = mysqli_prepare($db, "UPDATE Utilisateur SET mail = ? WHERE login = '$login'");
        mysqli_stmt_bind_param($stmt, "s", $newMail);
        if (mysqli_execute($stmt)) {
            header("Location: " . $redirect);
        } else {
            die("Erreur: $sql");
        }
    } else {
        return false;
    }
}

function _changerRole(mysqli $db, string $role, string $redirect)
{
    $login = $_SESSION['login'];
    $role = mysqli_real_escape_string($db, $role);
    $stmt = mysqli_prepare($db, "UPDATE Utilisateur SET role=? WHERE login='$login'");
    mysqli_stmt_bind_param($stmt, "s", $role);
    if (mysqli_execute($stmt)) {
        $_SESSION['role'] = $role;
        header("Location: " . $redirect);
    } else {
        return false;
    }
}

function _changerNom(mysqli $db, string $nom, string $redirect)
{
    $nom = mysqli_real_escape_string($db, $nom);
    $login = $_SESSION['login'];
    $stmt = mysqli_prepare($db, "UPDATE Utilisateur SET nom = ? WHERE login = '$login'");
    mysqli_stmt_bind_param($stmt, "s", $nom);
    if (mysqli_execute($stmt)) {
        $_SESSION['nom'] = $nom;
        header("Location: " . $redirect);
    } else {
        return false;
    }
}

function _changerPrenom(mysqli $db, string $prenom, string $redirect)
{
    $prenom = mysqli_real_escape_string($db, $prenom);
    $login = $_SESSION['login'];
    $stmt = mysqli_prepare($db, "UPDATE Utilisateur SET prenom = ? WHERE login = '$login'");
    mysqli_stmt_bind_param($stmt, "s", $prenom);
    if (mysqli_execute($stmt)) {
        $_SESSION['prenom'] = $prenom;
        header("Location: " . $redirect);
    } else {
        return false;
    }

}

function _changerBday(mysqli $db, string $date, string $redirect)
{
    $date = mysqli_real_escape_string($db, $date);
    $login = $_SESSION['login'];
    $stmt = mysqli_prepare($db, "UPDATE Utilisateur SET bday = ? WHERE login = '$login'");
    mysqli_stmt_bind_param($stmt, "s", $date);
    if (mysqli_execute($stmt)) {
        header("Location: " . $redirect);
    } else {
        return false;
    }
}

function _changerInfo(mysqli $db, string $prenom, string $nom, string $date)
{
    $prenom = mysqli_real_escape_string($db, $prenom);
    $nom = mysqli_real_escape_string($db, $nom);
    $date = mysqli_real_escape_string($db, $date);
    $login = $_SESSION['login'];
    $stmt = mysqli_prepare($db, "UPDATE Utilisateur SET prenom = ?, nom = ?, bday = ? WHERE login = '$login' ");
    mysqli_stmt_bind_param($stmt, "sss", $prenom, $nom, $date);
    if (mysqli_execute($stmt)) {
        header("Location: account.php");
    } else {
        return false;
    }
}

function _creerUtilisateur(mysqli $db, string $login, string $mail, string $pswrd, string $prenom, string $nom, string $bday)
{
    $login = mysqli_real_escape_string($db, $login);
    $mail = mysqli_real_escape_string($db, $mail);
    $pswrd = mysqli_real_escape_string($db, $pswrd);
    $prenom = mysqli_real_escape_string($db, $prenom);
    $nom = mysqli_real_escape_string($db, $nom);
    $bday = mysqli_real_escape_string($db, $bday);
    $sql = "INSERT INTO Utilisateur(login, mail, paswrd, prenom, nom, bday) VALUES('$login', '$mail', '$pswrd', '$prenom', '$nom', '$bday')";
    mysqli_query($db, $sql);
    header("Location: ./index.php");
}

function _recuppererInfo(mysqli $db)
{
    $login = $_SESSION['login'];
    $sql = "SELECT * FROM Utilisateur WHERE login = '$login'";
    $res = mysqli_query($db, $sql);
    if ($row = mysqli_fetch_assoc($res)) {
        return $row;
    }

}

function _ajouterEvenement(mysqli $db, string $nomEv, string $date, string $information, string $accreditation)
{
    $nomEv = mysqli_real_escape_string($db, $nomEv);
    $date = mysqli_real_escape_string($db, $date);
    $information = mysqli_real_escape_string($db, $information);
    $accreditation = mysqli_real_escape_string($db, $accreditation);
    $info = _recuppererInfo($db);
    $initParticipant = 1;
    $createur = $info['login'];

    $stmt = mysqli_prepare($db, "INSERT INTO Evenement (nom, createur, dateEvenement, information, nbParticipant, accreditation )VALUE (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssi", $nomEv, $createur, $date, $information, $initParticipant, $accreditation );
    if (mysqli_execute($stmt)) {
        header("Location: index.php");
    } else {
        return false;
    }

}

function _recupererEve(mysqli $db)
{
    $sql = "SELECT * FROM Evenement";
    return mysqli_query($db, $sql);
}

function _verifCreateur(mysqli $db, string $createur)
{
    $createur = mysqli_real_escape_string($db, $createur);
    $stmt = mysqli_prepare($db, "SELECT login FROM Utilisateur WHERE login = ?");
    mysqli_stmt_bind_param($stmt, "s", $createur);
    mysqli_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $ligne = mysqli_stmt_num_rows($stmt);
    if($ligne == 1){
        return true;
    }else{
        return false;
    }
}

function _recupererEveByCreat($db, $createur)
{
    $createur = mysqli_real_escape_string($db, $createur);
    if(_verifCreateur($db, $createur)){
        $sql = "SELECT * FROM Evenement WHERE login = '$createur' ORDER BY date";
        return mysqli_query($db, $sql);
    }else{
        return false;
    }

}

function _verifDate(mysqli $db, string $date)
{
    $date = mysqli_real_escape_string($db, $date);
    $stmt = mysqli_prepare($db, "SELECT * FROM Evenement WHERE date = '$date" );
    mysqli_stmt_bind_param($stmt, "s", $date);
    mysqli_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $ligne = mysqli_stmt_num_rows($stmt);
    if($ligne >= 1){
        return true;
    }else{
        return false;
    }
}
function _recupererEveByDate(mysqli $db, string $date)
{
    $date = mysqli_real_escape_string($db, $date);
    if(_verifDate($db, $date)){
        $sql = "SELECT * FROM Evenement WHERE login = '$date' ORDER BY date";
        return mysqli_query($db, $sql);
    }else{
        return false;
    }
}

function _recupererEveOrderData(mysqli $db){
    $sql = "SELECT * FROM Evenement ORDER BY date";
    return mysqli_query($db, $sql);
}

function _recupererEveOrderPartASC(mysqli $db){
    $sql = "SELECT * FROM Evenement ORDER BY nbParticipant ASC";
    return mysqli_query($db, $sql);
}

function _recupererEveOrderPartDESC(mysqli $db){
    $sql = "SELECT * FROM Evenement ORDER BY nbParticipant DESC";
    return mysqli_query($db, $sql);
}

function _verifAccreditation(mysqli $db, $id){
    // envoyer dans un champ cacher l'id pour pouvoir retrouver l'evenement
    $sql = "SELECT * FROM Evenement WHERE id= $id";
    $res = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($res);
    $accreditation = $row['accreditation'];
    $userRole = $_SESSION['role'];
    // on creer une nouvelle session qui servira a acceder a un evenement
    // il faudra mettre a jour la session en revenant sur la page principal des evenements
    if($accreditation == "sympathisant"){
        $_SESSION['accreditation'] = true;
    }else if($accreditation == "gestionnaire"){
        if($userRole == "gestionnaire"){
            $_SESSION['accreditation'] = true;
        }else{
            $_SESSION['accreditation'] = false;
        }
    }else if ($accreditation == "adhérant"){
        if($userRole == "sympathisant"){
            $_SESSION['accreditation'] = false;
        }else{
            $_SESSION['accreditation'] = true;
        }
    }

}
// cree une cle et la hasher avec hashmac et la mettre dans un session champ cacher

// faire des requete preparer avec mysqli prepare et mysqli_stmt_bind_param($stmt, "s", $city)

// html special car pour afficher des ino-formation venu de html
// filter input
// nl2br
?>