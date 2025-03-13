CREATE TABLE clients (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO `clients` (`id`, `name`, `email`) VALUES (NULL, 'John', 'John@gmail.com'), (NULL, 'Bob', 'Bob@gmail.com'), (NULL, 'Sam', 'Sam@gmail.com');

SELECT * FROM `clients`