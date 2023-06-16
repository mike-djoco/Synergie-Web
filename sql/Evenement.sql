CREATE TABLE Evenement(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom varchar(255) NOT NULL,
    createur varchar(255) REFERENCES Utilisateur(login),
    type varchar(40) DEFAULT 'rassemblement' -- ou reunion
    dateCreation date DEFAULT GETDATE(),
    dateEvenement date NOT NULL,
    information text NOT NULL,
    accredidation varchar(255) NOT NULL
);
