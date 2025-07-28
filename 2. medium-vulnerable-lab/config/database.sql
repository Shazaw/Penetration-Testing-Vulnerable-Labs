-- This script sets up the database for the Medium Vulnerable Lab.
-- It should be executed by the root MySQL user.

DROP DATABASE IF EXISTS social_media;
DROP USER IF EXISTS 'webapp'@'localhost';

CREATE DATABASE social_media;
USE social_media;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50),
  password VARCHAR(50)
);

INSERT INTO users (username, password) VALUES ('admin426', 'RANDOM_COMPLEX_PASSWORD');

CREATE USER 'webapp'@'localhost' IDENTIFIED BY 'SuperSecureDBPass123!';
GRANT ALL PRIVILEGES ON social_media.* TO 'webapp'@'localhost';
FLUSH PRIVILEGES;
