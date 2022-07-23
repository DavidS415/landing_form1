CREATE DATABASE leadform1;

GRANT ALL ON leadform1.* to leadformadmin@localhost IDENTIFIED BY 'Password'; 

use leadform1;

CREATE TABLE submission(
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(225),
    company_url VARCHAR(225),
    contact_name VARCHAR(225),
    contact_email VARCHAR(225),
    contact_number VARCHAR(225)
    );

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE new_users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);