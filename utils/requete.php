<?php

//
//
//  Modification du compte ////////////////////////////////////////////////////////////
//
//
//
//
//
//

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

function _creerUtilisateur(mysqli $db, string $login, string $mail, string $pswrd, string $prenom, string $nom, string $bday, string $role)
{
    $login = mysqli_real_escape_string($db, $login);
    $mail = mysqli_real_escape_string($db, $mail);
    $pswrd = mysqli_real_escape_string($db, $pswrd);
    //$pswrd = password_hash($pswrd, PASSWORD_DEFAULT);
    $prenom = mysqli_real_escape_string($db, $prenom);
    $nom = mysqli_real_escape_string($db, $nom);
    $bday = mysqli_real_escape_string($db, $bday);
    $sql = "INSERT INTO Utilisateur(login, mail, paswrd, prenom, nom, bday, role) VALUES('$login', '$mail', '$pswrd', '$prenom', '$nom', '$bday', '$role')";
    mysqli_query($db, $sql);
    header("Location: ./index.php");
}

function _recuppererInfo(mysqli $db)
{
    $login = $_SESSION['login'];
    $sql = "SELECT * FROM Utilisateur WHERE login = '$login'";
<<<<<<< HEAD
    return mysqli_query($db, $sql);
}
=======
    $res = mysqli_query($db, $sql);
    if ($row = mysqli_fetch_assoc($res)) {
        return $row;
    }

}

//
//
//  Relatif au evenement /////////////////////////////////////////////////
//
//
//
//
//
//


// outils pour les evenements
>>>>>>> 73beeaf99810010a74ea59e8b4632c933baeb547

//
//
//  Relatif au evenement /////////////////////////////////////////////////
//
//
//
//
//
//


// outils pour les evenements

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
function _verifAccreditation(mysqli $db, $id){
    // envoyer dans un champ cacher l'id pour pouvoir retrouver l'evenement
    $sql = "SELECT * FROM Evenement WHERE id= '$id'";
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

function _peutCreeEvenement(mysqli $db){
    if($_SESSION['role'] == "gestionnaire"){
        return true;
    }else{
        return false;
    }
}

<<<<<<< HEAD
function _getOneEvenement(mysqli $db, string $nom, string $createur){
    $sql = "SELECT * FROM Evenement  WHERE nom = '$nom' et createur = '$createur'";
    return mysqli_query($db, $sql);
}

=======
>>>>>>> 73beeaf99810010a74ea59e8b4632c933baeb547

//  requete evenement
function _ajouterEvenement(mysqli $db, string $nomEv, string $date, string $information, string $accreditation)
{
    $nomEv = mysqli_real_escape_string($db, $nomEv);
    $date = mysqli_real_escape_string($db, $date);
    $information = mysqli_real_escape_string($db, $information);
    $accreditation = mysqli_real_escape_string($db, $accreditation);
    $info = _recuppererInfo($db);
<<<<<<< HEAD
    $info = mysqli_fetch_assoc($info);
    $createur = $info['login'];

    $stmt = mysqli_prepare($db, "INSERT INTO Evenement(nom, createur, dateEvenement, information, accreditation ) VALUE (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $nomEv, $createur, $date, $information, $accreditation);
    if (mysqli_execute($stmt)) {
        $sql = "SELECT * FROM Evenement WHERE nom = '$nomEv' AND createur = '$createur'";
        $req = mysqli_query($db, $sql);
        $res = mysqli_fetch_assoc($req);
        $id = $res['id'];
        $stmt = mysqli_prepare($db, "INSERT INTO Inscrit(loginUtilisateur, idEvenement) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $createur, $id);
        mysqli_execute($stmt);
=======
    $createur = $info['login'];

    $stmt = mysqli_prepare($db, "INSERT INTO Evenement (nom, createur, dateEvenement, information, accreditation )VALUE (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $nomEv, $createur, $date, $information, $accreditation );
    if (mysqli_execute($stmt)) {
>>>>>>> 73beeaf99810010a74ea59e8b4632c933baeb547
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


<<<<<<< HEAD
function _recupererEveByCreat(mysqli $db, string $createur)
{
    $createur = mysqli_real_escape_string($db, $createur);
    if(_verifCreateur($db, $createur)){
        $sql = "SELECT * FROM Evenement WHERE createur = '$createur' ORDER BY dateEvenement";
=======
function _recupererEveByCreat($db, string $createur)
{
    $createur = mysqli_real_escape_string($db, $createur);
    if(_verifCreateur($db, $createur)){
        $sql = "SELECT * FROM Evenement WHERE login = '$createur' ORDER BY date";
>>>>>>> 73beeaf99810010a74ea59e8b4632c933baeb547
        return mysqli_query($db, $sql);
    }else{
        return false;
    }

}


function _recupererEveByDate(mysqli $db, string $date)
{
    $date = mysqli_real_escape_string($db, $date);
    if(_verifDate($db, $date)){
<<<<<<< HEAD
        $sql = "SELECT * FROM Evenement WHERE dateEvenement = '$date' ORDER BY dateEvenement";
=======
        $sql = "SELECT * FROM Evenement WHERE dateEvenement = '$date' ORDER BY date";
>>>>>>> 73beeaf99810010a74ea59e8b4632c933baeb547
        return mysqli_query($db, $sql);
    }else{
        return false;
    }
}

function _recupererEveOrderData(mysqli $db){
    $sql = "SELECT * FROM Evenement ORDER BY dateEvenement DESC";
    return mysqli_query($db, $sql);
}

function _recupererEveOrderPartASC(mysqli $db){
    $sql = "SELECT *, COUNT(*) FROM Evenement INNER JOIN Inscrit ON Evenement.id = Inscrit.idEvenement GROUP BY Evenement.id ORDER BY COUNT(*) ASC";
    return mysqli_query($db, $sql);
}

function _recupererEveOrderPartDESC(mysqli $db){
<<<<<<< HEAD
    $sql = "SELECT *, COUNT(*) FROM Evenement INNER JOIN   ON Evenement.id = Inscrit.idEvenement GROUP BY Evenement.id ORDER BY COUNT(*) DESC";
=======
    $sql = "SELECT *, COUNT(*) FROM Evenement INNER JOIN Inscrit ON Evenement.id = Inscrit.idEvenement GROUP BY Evenement.id ORDER BY COUNT(*) DESC";
>>>>>>> 73beeaf99810010a74ea59e8b4632c933baeb547
    return mysqli_query($db, $sql);
}


function _sinscritEve(mysqli $db, $id, string $login){
    $sql = "INSERT INTO Inscrit(loginUtilisateur, idEvenement) VALUE ('$login', '$id')";
    if(mysqli_query($db, $sql)){
        return true;
    }else{
        return false;
    }
}

function _deInscrit(mysqli $db, $id, string $login){
    $sql = "DELETE FROM Inscrit WHERE loginUtilisateur = $login AND idEvenement = '$id'";
    if(mysqli_query($db, $sql)){
        return true;
    }else{
        return false;
    }
}

function _nbParticipant(mysqli $db, $idEve){
    $sql = "SELECT * FROM Inscrit WHERE idEvenement = '$idEve'";
    $req = mysqli_query($db, $sql);
    return mysqli_num_rows($$req);
}

function _supprimerEve(mysqli $db, $id){
    $sql = "DELETE FROM Evenement WHERE id = '$id'";
    return mysqli_query($db, $sql);
}

//
//
//  Relatif au commentaire
//
//
//
//
//
//
//

function _commente(mysqli $db, $id, string $login, string $comment){
    $stmt = mysqli_prepare($db, "INSERT INTO Commentaire(loginUtilisateur, idEvenement, commentaire) VALUES (?,?,?)");
    mysqli_stmt_bind_param($stmt, "sss", $id, $login, $comment);
    if(mysqli_execute($stmt)){
        return true;
    }else{
        return false;
    }
}

function _deleteCom(mysqli $db, $idComment){
    $sql = "DELETE FROM Commentaire WHERE idCommentaire = '$idComment'";
    if(mysqli_query($db, $sql)){
        return true;
    }else{
        return false;
    }
}


// nombre de commentaire
function _nbCommentaire(mysqli $db, $idEve){
    $sql = "SELECT * FROM Commentaire WHERE idEvenement = '$idEve'";
    $req  = mysqli_query($db, $sql);
    return mysqli_num_rows($req);
}

function _fetchComment(mysqli $db, $idEve){
    $sql = "SELECT * FROM Commentaire WHERE idEvenement = '$idEve'";
    return mysqli_query($db, $sql);
}

function _estCreateur(mysqli $db, $idEve, string $login){
    $login = mysqli_real_escape_string($db, $login);
    $sql = "SELECT * FROM Evenement WHERE id = '$idEve'";
    $req = mysqli_query($db, $sql);
    $res = mysqli_fetch_assoc($req);
    if ($login == $res['createur']){
        return true;
    }else{
        return false;
    }
}



// cree une cle et la hasher avec hashmac et la mettre dans un session champ cacher

// faire des requete preparer avec mysqli prepare et mysqli_stmt_bind_param($stmt, "s", $city)

// html special car pour afficher des ino-formation venu de html
// filter input
// nl2br
?>