CREATE DATABASE in_class_17;
USE in_class_17;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE userComments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    comment_text TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
INSERT INTO users (username, email) VALUES 
('John', 'John@gmail.com'),
('Bob', 'Bob@gmail.com'), 
('Sam', 'Sam@gmail.com');

INSERT INTO userComments (user_id, comment_text) VALUES
(1, 'This is John\'s first comment!'),
(1, 'Johns comment again'),
(2, 'Bob first comment'),
(3, 'Sam\'s first comment');

SELECT users.user_id, users.username, users.email, userComments.comment_text 
FROM users 
LEFT JOIN userComments ON users.user_id = userComments.user_id;

SELECT users.user_id, users.username, users.email, userComments.comment_text 
FROM users 
INNER JOIN userComments ON users.user_id = userComments.user_id;
