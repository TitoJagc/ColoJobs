DROP DATABASE IF EXISTS colojobs;
CREATE DATABASE colojobs;

USE colojobs;

CREATE TABLE User (
 id CHAR(9) NOT NULL PRIMARY KEY,
 name VARCHAR(200) NOT NULL,
 pwd VARCHAR(100) NOT NULL,
 dateofBirth DATE NOT NULL,
 telephone VARCHAR(13),
 addressStreet VARCHAR(200),
 municipality enum('Eivissa','Sant Antoni','Sant Joan','Sant Josep','Santa Eulària'),
 postalCode CHAR(5),
 email VARCHAR(100),
 rol enum('Student', 'Teacher', 'Company'),
 image VARCHAR(200)
);

CREATE TABLE Student (
 id CHAR(9) NOT NULL PRIMARY KEY,
 wantsToReceiveOffers BOOL,
 CONSTRAINT fk_student_user FOREIGN KEY (id) REFERENCES User(id)
);

CREATE TABLE Company (
 id CHAR(9) NOT NULL PRIMARY KEY,
 CONSTRAINT fk_company_user FOREIGN KEY (id) REFERENCES User(id)
);

CREATE TABLE Teacher (
 id CHAR(9) NOT NULL PRIMARY KEY,
 CONSTRAINT fk_teacher_user FOREIGN KEY (id) REFERENCES User(id)
);

CREATE TABLE Offer (
 num INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 description TEXT,
 dateStart TIMESTAMP,
 dataEnd DATE,
 validatedBy CHAR(9) NOT NULL,
 CONSTRAINT fk_offer_teacher FOREIGN KEY (validatedBy) REFERENCES Teacher(Id)
);

CREATE TABLE Speciality (
 name VARCHAR(50) NOT NULL PRIMARY KEY
);

CREATE TABLE Competence (
 keyword VARCHAR(100) NOT NULL PRIMARY KEY,
 speciality VARCHAR(50) REFERENCES Speciality(name)
);

CREATE TABLE OfferListCompetences (
 competence VARCHAR(100) NOT NULL,
 offer INT NOT NULL,
 PRIMARY KEY (competence,offer),
 CONSTRAINT fk_olc_competence FOREIGN KEY (competence) REFERENCES Competence(keyword),
 CONSTRAINT fk_olc_offer FOREIGN KEY (offer) REFERENCES Offer(num)
);

CREATE TABLE Cicle ( #VocationalTraining
 name VARCHAR(100) NOT NULL PRIMARY KEY
);

CREATE TABLE CicleListCompetences (
 cicle VARCHAR(100) NOT NULL,
 competence VARCHAR(100) NOT NULL,
 PRIMARY KEY (cicle,competence),
 CONSTRAINT fk_clc_cicle FOREIGN KEY (cicle) REFERENCES Cicle(name),
 CONSTRAINT fk_clc_competence FOREIGN KEY (competence) REFERENCES Competence(keyword)
);

CREATE TABLE StudentListCicles (
 student CHAR(9) NOT NULL,
 cicle VARCHAR(100) NOT NULL,
 PRIMARY KEY (student,cicle),
 CONSTRAINT fk_slc_student FOREIGN KEY (student) REFERENCES Student(id),
 CONSTRAINT fk_slc_cicle FOREIGN KEY (cicle) REFERENCES Cicle(name)
);

CREATE TABLE BaseLanguages(
	name VARCHAR(50) NOT NULL PRIMARY KEY
);
INSERT INTO BaseLanguages VALUES ('Anglès'),('Castellà'),('Català'),('Alemany'),('Xinès'),('Rus');

CREATE TABLE StudentKnownLanguages (
 student CHAR(9) NOT NULL,
 language VARCHAR(50) NOT NULL,
 isMotherTongue BOOL NOT NULL DEFAULT FALSE,
 spokenLevel enum('A1','A2','B1','B2','C1','C2'),
 writtenLevel enum('A1','A2','B1','B2','C1','C2'),
 readingLevel enum('A1','A2','B1','B2','C1','C2'),
 CONSTRAINT pk_kl PRIMARY KEY (student, language),
 CONSTRAINT fk_kl_student FOREIGN KEY (student) REFERENCES Student(id),
 CONSTRAINT fk_kl_language FOREIGN KEY (language) REFERENCES BaseLanguages(name)
);

CREATE TABLE StudentJobExperience (
 student CHAR(9) NOT NULL,
 num INT NOT NULL,
 employer VARCHAR(100) NOT NULL,
 sector VARCHAR(100),
 position VARCHAR(100),
 mainActivities TEXT,
 startDate DATE NOT NULL,
 endDate DATE NOT NULL,
 CONSTRAINT pk_sje PRIMARY KEY (student, num),
 CONSTRAINT fk_sje_student FOREIGN KEY (student) REFERENCES Student(id)
);

CREATE TABLE StudentOtherEducation (
 student CHAR(9) NOT NULL,
 num INT NOT NULL,
 organization VARCHAR(100) NOT NULL,
 mainLearnedCapacities TEXT,
 title VARCHAR(100) NOT NULL,
 startDate DATE NOT NULL,
 endDate DATE NOT NULL,
 CONSTRAINT pk_soe PRIMARY KEY (student, num),
 CONSTRAINT fk_soe_student FOREIGN KEY (student) REFERENCES Student(id)
);

CREATE TABLE StudentDrivingLicence (
 student CHAR(9) NOT NULL,
 licence enum('AM-Ciclomotor','A','B'),
 CONSTRAINT pk_sdl PRIMARY KEY (student, licence),
 CONSTRAINT fk_sdl_student FOREIGN KEY (student) REFERENCES Student(id)
);

#
#### INSERT STUDENT USER + LANGUAGES
#
START TRANSACTION;

SET @DNI = '41457308S';

INSERT INTO User (id, name, pwd, dateOfBirth, telephone, addressStreet, municipality, postalCode, email)
  VALUES (@DNI, 'Nicolás Muñoz', 'root' , STR_TO_DATE('1974-04-24', '%Y-%m-%d'), '660026265', 'C/ Sant Agustí 7', 'Santa Eulària','07813','nmunoz@iessacolomina.es');

INSERT INTO Student VALUES (@DNI, TRUE);

COMMIT;

#
#### DRIVING LICENCE + 
#
START TRANSACTION;

SET @DNI = '41457308S';

INSERT INTO StudentDrivingLicence VALUES(@DNI, 'A'), (@DNI,'B');

INSERT INTO StudentKnownLanguages VALUES(@DNI, 'Castellà', TRUE, NULL, NULL, NULL);
INSERT INTO StudentKnownLanguages VALUES(@DNI, 'Català', FALSE, 'C1', 'C1', 'C1');
INSERT INTO StudentKnownLanguages VALUES(@DNI, 'Anglès', FALSE, 'C1', 'C1', 'C1');

COMMIT;




