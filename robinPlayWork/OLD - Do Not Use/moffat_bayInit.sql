DROP DATABASE IF EXISTS moffat_bay;

CREATE DATABASE moffat_bay;

USE moffat_bay;

DROP TABLE IF EXISTS customer;

CREATE TABLE customer (
    customerid INT(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    telephone VARCHAR(12),
    password VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS reservation;

CREATE TABLE reservation (
    reservationid INT(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    customerid INT(10) NOT NULL,
    checkin DATE NOT NULL,
    checkout DATE NOT NULL,
    numberguests INT(1) NOT NULL,
    roomsize VARCHAR(12) NOT NULL,
    FOREIGN KEY (customerid) REFERENCES customer(customerid)
);

INSERT INTO customer
    (email, firstname, lastname, telephone, password)
    VALUES 
        ('amanda@mbl.com', 'Amanda', 'Sherman', '123-456-7890', 'hashedpassword'),
        ('caleb@mbl.com', 'Caleb', 'Rummel', '123-456-7890', 'hashedpassword'),
        ('karendaysu@mbl.com', 'Karendaysu', 'Wolfe', '123-456-7890', 'hashedpassword'),
        ('robin@mbl.com', 'Robin', 'Pindel', '123-456-7890', 'hashedpassword');

INSERT INTO reservation
    (customerid, checkin, checkout, numberguests, roomsize)
    VALUES
        (1, '2023-01-01', '2023-01-05', 2, 'Double Full'),
        (2, '2023-09-01', '2023-09-05', 2, 'Double Queen'),
        (3, '2023-10-15', '2023-10-20', 1, 'Queen'),
        (4, '2023-11-01', '2023-11-07', 2, 'King');

