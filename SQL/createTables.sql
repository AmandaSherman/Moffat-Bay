USE moffat_bay;

CREATE TABLE customer (
    customerid INT(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    telephone VARCHAR(12),
    password VARCHAR(255) NOT NULL
);


CREATE TABLE reservation (
    reservationid INT(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    customerid INT(10) NOT NULL,
    checkin DATE NOT NULL,
    checkout DATE NOT NULL,
    numberguests INT(1) NOT NULL,
    roomsize VARCHAR(12) NOT NULL
    FOREIGN KEY (customerid) REFERENCES customer(customerid)
);