CREATE DATABASE IF NOT EXISTS portfolio;
USE portfolio;

CREATE TABLE IF NOT EXISTS projects(
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  description TEXT,
  image VARCHAR(255),
  project_link VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS messages(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  message TEXT
);

CREATE TABLE IF NOT EXISTS users(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

INSERT INTO projects (title, description, image, project_link) VALUES
('Art History Information System','DSA Project: Stack Structure. A scholarly interface for browsing art history.','proj1.Stack.png','#'),
('Patient Queue Organization','DSA Project: Queue Structure. Patient queueing for Carillo-Ternida Hospital.','proj2.Queue.png','#'),
('D&A Jewelry Shops Directory','DSA Project: Graph Structure. A directory of jewelry shops built on a graph.','proj3.Graph.png','#'),
('KARMD Flower Shop API','Backend API for a flower shop.','proj4.API.png','#'),
('Student Registration API','CRUD backend for student registration.','proj5.APIDTO.png','#'),
('School Enrollment System','Enrollment system for Andres Bonifacio University.','proj6.EnrollmentSystem.png','#');
