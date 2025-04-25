CREATE DATABASE IF NOT EXISTS portfolio_db;
USE portfolio_db;

CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL,
    demo_link VARCHAR(255),
    code_link VARCHAR(255),
    tags VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL
);

INSERT INTO projects (title, description, image, category, demo_link, code_link, tags) VALUES
('Personal Blog', 'A simple blog layout using HTML and CSS', 'https://via.placeholder.com/300x200', 'html', 'https://github.com/Camilo184/cisc3300', 'https://github.com/Camilo184/cisc3300', 'HTML,CSS'),
('To-Do List App', 'A simple to-do list application with JavaScript', 'https://via.placeholder.com/300x200', 'js', '#', '#', 'HTML,CSS,JavaScript'),
('Weather App', 'A weather application using a free API', 'https://via.placeholder.com/300x200', 'js', '#', '#', 'HTML,CSS,JavaScript'),
('Restaurant Website', 'A responsive website for a local restaurant', 'https://via.placeholder.com/300x200', 'html', '#', '#', 'HTML,CSS');