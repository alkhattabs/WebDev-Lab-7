-- Step 1: Create the database
CREATE DATABASE Lab_7;

-- Step 2: Use the database
USE Lab_7;

-- Step 2: Create the users table
CREATE TABLE users (
    matric VARCHAR(10) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(10) NOT NULL
); 