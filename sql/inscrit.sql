CREATE TABLE Inscrit(
    loginUtilisateur varchar(255) NOT NULL REFERENCES Utilisateur(login);
    idEvenement int NOT NULL REFERENCES Evenement(id),
    PRIMARY KEY (loginUtilisateur, idEvenement)
);