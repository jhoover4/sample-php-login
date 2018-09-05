DROP DATABASE IF EXISTS sample_php_login;
CREATE DATABASE sample_php_login;

USE sample_php_login;

CREATE TABLE Clients (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  PRIMARY KEY (id)
);

CREATE TABLE Login (
  id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

# Sample data, Login can be updated after DB is created
INSERT INTO Clients (name, description)
VALUES ('B. Test Client', 'A sample description.'),
       ('E. Test Client', 'A sample description.'),
       ('C. Test Client', 'A sample description.'),
       ('D. Test Client', 'A sample description.'),
       ('A. Test Client', 'A sample description.');
INSERT INTO Login (username, password)
VALUES ('admin', 'admin');