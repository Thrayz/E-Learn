drop database if exists elearn;
create database if not exists elearn;
use elearn;

create table Etudiant(
    idEtudiant int(4) auto_increment primary key,
    nom varchar(50),
    prenom varchar(50),
    civilite varchar(50),
    photo varchar(100),
    idFiliere int(4)
);

create table filiere(
    idFiliere int(4) auto_increment primary key,
    nomFiliere varchar(50),
    niveau varchar(50)
);

create table utilisateur(
    iduser int(4) auto_increment primary key,
    login varchar(50),
    email varchar(255),
    role varchar(50),  
    etat int(1),        
    pwd varchar(255)
);

Alter table Etudiant add constraint 
    foreign key(idFiliere) references filiere(idFiliere);

INSERT INTO filiere(nomFiliere,niveau) VALUES
	('DSI','LICENCE'),
	('RSI','LICENCE'),
	('M','TECHNICIEN'),
	('Technique de Recherche','MASTER');
INSERT INTO utilisateur(login,email,role,etat,pwd) VALUES 
    ('admin','admin@gmail.com','ADMIN',1,'1234');			

INSERT INTO Etudiant(nom,prenom,civilite,photo,idFiliere) VALUES
    ('Mezrigui','Oussama','Homme','',1),
	('Abidi','Ahmed','Homme','',2),
	('Ben Alaya','Abrar','Femme','',4);

select * from filiere;
select * from Etudiant;
select * from utilisateur;


