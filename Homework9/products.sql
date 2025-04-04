CREATE DATABASE  mybusiness;
USE mybusiness;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL
);

INSERT INTO products (name, description, price) VALUES
('Laptop Pro', 'A high-performance laptop for professionals.', 1200.00),
('Gaming Mouse', 'A precision mouse for gaming enthusiasts.', 49.99),
('Mechanical Keyboard', 'A durable and responsive keyboard.', 89.99);
