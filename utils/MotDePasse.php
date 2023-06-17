<?php

    function _verificationMDP(mysqli $db,string $pswrd){
        if (strlen($pswrd)<8) { // si le mot de passe est trop court
            return false;
        }else if (strlen($pswrd)>=8) { // verification de la longueur du mot de passe
            $nbMaj=0;
            $nbChif=0;
            $nbCharS=0;
            for ($i=0; $i < strlen($pswrd); $i++) { // boucle pour verifier qu'on est toute les caractéristique du mdp
                $char = substr($pswrd, $i, 1);
                // on verifie qu'on est des chiffre, des caractere speciaux et des majuscules
                if ($char=='0' || $char=='1' || $char=='2' || $char=='3' || $char=='4' || $char=='5' || $char=='6' || $char=='7' || $char=='8' || $char=='9') {
                    $nbChif++;
                }else if ($char=='.' || $char=='!' || $char=='?' || $char=='€' || $char=='*') {
                    $nbCharS++;
                }else if ($char>= 'A' && $char<='Z') {
                    $nbMaj++;
                }
            }
            // si le mot de passe est correct alors on crée l'utilisateur
            if ($nbMaj>=1 && $nbChif>=1 && $nbCharS>=1) {
                return true;
            }
        }
        
    }
?>