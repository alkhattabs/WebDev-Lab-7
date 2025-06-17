CREATE DATABASE Lab_7;


USE Lab_7;
CREATE TABLE users (
    matric VARCHAR(10) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(10) NOT NULL
); 
