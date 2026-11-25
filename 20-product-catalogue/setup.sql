-- Run this in your "test" database (change db name if needed)

DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(10,2) NOT NULL,
  category_id INT NOT NULL,
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

INSERT INTO categories (name) VALUES
('Electronics'),   -- 1
('Clothing'),      -- 2
('Toys'),          -- 3
('Home & Kitchen'),-- 4
('Books');         -- 5

INSERT INTO products (title, description, price, category_id) VALUES
('Wireless Headphones', 'Bluetooth over-ear headphones with 30h battery life.', 59.99, 1),
('USB-C Charger 65W', 'Fast charger for laptops and phones.', 29.50, 1),
('Smart Watch', 'Fitness tracker with heart rate monitor and GPS.', 89.00, 1),
('Denim Jacket', 'Classic blue denim jacket, unisex fit.', 49.90, 2),
('Cotton T-Shirt', 'Soft plain white t-shirt, 100% cotton.', 12.99, 2),
('Running Shoes', 'Lightweight breathable running shoes.', 74.95, 2),
('Building Blocks Set', '500 piece colorful building blocks for kids.', 24.99, 3),
('Remote Control Car', 'Fast RC car with rechargeable battery.', 34.50, 3),
('Plush Teddy Bear', 'Super soft teddy bear, 40cm tall.', 15.00, 3),
('Coffee Maker', 'Programmable 12 cup drip coffee maker.', 45.00, 4),
('Non-stick Frying Pan', '28cm frying pan, dishwasher safe.', 22.75, 4),
('Learn PHP in a Weekend', 'Beginner friendly guide to PHP and MySQL.', 19.99, 5),
('Sci-Fi Short Stories', 'Collection of classic science fiction tales.', 11.49, 5);
