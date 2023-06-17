CREATE TABLE Utilisateur(
    login varchar(20) NOT NULL PRIMARY KEY,
    prenom varchar(40) NOT NULL,
    nom varchar(40) NOT NULL,
    mail varchar(40) NOT NULL,
    bday varchar(40) NOT NULL,
    paswrd varchar(255) NOT NULL,
    role varchar(20) DEFAULT 'sympathisant'
);