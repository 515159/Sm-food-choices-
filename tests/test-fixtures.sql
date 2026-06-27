CREATE DATABASE IF NOT EXISTS register;
USE register;

CREATE TABLE IF NOT EXISTS signup (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS food_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  vendor_id INT DEFAULT NULL,
  category VARCHAR(100) NOT NULL,
  name VARCHAR(255) NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  is_vegetarian BOOLEAN DEFAULT TRUE
);

DELETE FROM signup;
INSERT INTO signup (name, password) VALUES
  ('existing_user', 'existing_pass'),
  ('demo_user', 'demo_pass');

DELETE FROM food_items;
INSERT INTO food_items (vendor_id, category, name, price, is_vegetarian) VALUES
  (1, 'Starters', 'Spring Rolls', 120.00, TRUE),
  (1, 'Chinese', 'Veg Noodles', 150.00, TRUE),
  (2, 'Beverages', 'Cold Coffee', 90.00, TRUE);

