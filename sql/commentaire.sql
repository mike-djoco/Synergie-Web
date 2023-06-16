CREATE TABLE Commentaire(
    idCommentaire int PRIMARY KEY AUTO_INCREMENT;
    loginUtilisateur varchar(255) NOT NULL REFERENCES Utilisateur(login);
    idEvenement int NOT NULL REFERENCES Evenement,
    comment text NOT NULL
);