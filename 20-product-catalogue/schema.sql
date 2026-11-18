CREATE DATABASE IF NOT EXISTS php_lab;
USE php_lab;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

INSERT INTO products (name, category, description, price) VALUES
('Laptop', 'Electronics', 'A laptop for study and office work.', 55000.00),
('Headphones', 'Electronics', 'Wireless headphones with clear sound.', 1500.00),
('School Bag', 'Bags', 'A durable bag for everyday use.', 1200.00),
('Sports Shoes', 'Footwear', 'Comfortable shoes for sports and running.', 2200.00);
