/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  bernie
 * Created: 2021.05.23.
 */

DROP DATABASE IF EXISTS hasznaltverdak;

CREATE DATABASE hasznaltverdak DEFAULT CHARACTER SET=utf8 COLLATE utf8_hungarian_ci;

USE hasznaltverdak;

CREATE TABLE felhasznalok (
    uid INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(1024),
    email VARCHAR(512),
    jelszo VARCHAR(512),
    varos VARCHAR(512)
);


INSERT INTO felhasznalok (nev, email, jelszo, varos) VALUES
('admin', 'admin@hasznaltverdak.hu', MD5('admin'), 'Budapest');

/* statusz INT DEFAULT NULL, -- 1 = eladó, 2 = eladva, 3 = kifizetve */

CREATE TABLE autok (
    aid INT AUTO_INCREMENT PRIMARY KEY,
    szin VARCHAR(255) DEFAULT NULL,
    tipus VARCHAR(255) DEFAULT NULL,
    evjarat INT DEFAULT NULL,
    muszaki INT DEFAULT NULL,
    kilometer INT DEFAULT NULL,
    ar INT DEFAULT NULL,
    statusz INT DEFAULT NULL,
    uid INT,
    FOREIGN KEY (uid) REFERENCES felhasznalok(uid)
);


INSERT INTO autok (szin, tipus, evjarat, muszaki, ar, kilometer, statusz, uid) VALUES
('Zöld', 'Trabant 601', 1972, 2025, 245000, 75000, 1, 1);


CREATE TABLE kepek (
    pid INT AUTO_INCREMENT PRIMARY KEY,
    kep LONGBLOB,
    aid INT,
    FOREIGN KEY (aid) REFERENCES autok(aid)
);

DROP USER hv@localhost;

CREATE user hv@localhost IDENTIFIED BY "titok";
GRANT ALL PRIVILEGES ON hasznaltverdak.* to hv@localhost;

FLUSH PRIVILEGES;