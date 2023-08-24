DROP DATABASE IF EXISTS mbl;

CREATE DATABASE mbl;

USE mbl;

DROP TABLE IF EXISTS useraccounts;

CREATE TABLE useraccounts (
userid INT(10) Unsigned NOT NULL AUTO_INCREMENT,
email VARCHAR(100) NOT NULL,
fname VARCHAR(25) NOT NULL,
lname VARCHAR(25) NOT NULL,
telephone VARCHAR(12),
password VARCHAR(255) NOT NULL,
PRIMARY KEY(userid),
UNIQUE KEY email (email));

INSERT INTO useraccounts (email, fname, lname, telephone, password) VALUES ('test@test.com', 'ftest', 'ltest', 'tes-tph-one1', 'test1234');


DROP TABLE IF EXISTS reservations;

CREATE TABLE reservations (
reservationid INT(10) Unsigned NOT NULL AUTO_INCREMENT,
email VARCHAR(100) NOT NULL,
checkin DATE NOT NULL,
checkout DATE NOT NULL,
numberguests ENUM('1', '2', '3', '4', '5') NOT NULL,
roomsize ENUM('Double Full', 'Queen', 'Double Queen', 'King') NOT NULL,
PRIMARY KEY(reservationid),
FOREIGN KEY (email) REFERENCES useraccounts(email));

INSERT INTO reservations (email, checkin, checkout, numberguests, roomsize) VALUES ('test@test.com', '2023-01-01', '2023-01-05', '5', 'Double Queen');
