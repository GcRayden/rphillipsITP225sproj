DROP DATABASE IF EXISTS rp_sproj_db;
CREATE DATABASE rp_sproj_db;
USE rp_sproj_db;

DROP TABLE IF EXISTS rp_sproj_login;
CREATE TABLE rp_sproj_login (
  MemberID INT(11) NOT NULL AUTO_INCREMENT,
  Username VARCHAR(50) NOT NULL,
  Password VARCHAR(255) NOT NULL,
  FirstName VARCHAR(50),
  LastName VARCHAR(50),
  PRIMARY KEY(MemberID)
);

DROP TABLE IF EXISTS rp_sproj_quiz;
CREATE TABLE rp_sproj_quiz (
  QuizID INT(11) NOT NULL AUTO_INCREMENT,
  MemberID INT(11) NOT NULL,
  QuizName VARCHAR(50) NOT NULL,
  QuizQuestions VARCHAR(65535) NOT NULL,
  QuizAnswers VARCHAR(65535) NOT NULL,
  PRIMARY KEY (QuizID),
  CONSTRAINT FK_MemberID FOREIGN KEY (MemberID) REFERENCES rp_sproj_login(MemberID)
);

INSERT INTO rp_sproj_login 
  (Username, Password, FirstName, LastName)
VALUES 
  ('Admin', 'admin', '', ''),
  ('User', 'user', '', '');

DROP USER IF EXISTS 'rp_sprojuser'@'localhost';
CREATE USER 'rp_sprojuser'@'localhost' IDENTIFIED BY 'rp_sprojpass';
REVOKE ALL PRIVILEGES ON *.* FROM 'rp_sprojuser'@'localhost'; 
GRANT ALL PRIVILEGES ON *.* TO 'rp_sprojuser'@'localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;