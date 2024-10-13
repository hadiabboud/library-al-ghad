-- Create database
CREATE DATABASE library_db;
USE library_db;

-- Create user table
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    address VARCHAR(255),
    age INT,
    password VARCHAR(255)
);

-- Create admin table
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(100)
);

-- Create items table
CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    price DECIMAL(10, 2),
    quantity_available INT,
    category VARCHAR(100),
    description TEXT,
    images JSON
);

-- Create offers table
CREATE TABLE offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    discount_percentage DECIMAL(5, 2),
    start_date DATE,
    end_date DATE,
    user_id INT,
    items_id INT,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (items_id) REFERENCES items(id)
);

-- Create orders table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_placed TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    order_items TEXT,
    payment_status ENUM('Pending', 'Completed', 'Failed') DEFAULT 'Pending',
    shipping_method VARCHAR(100),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

-- Create delivery table
CREATE TABLE delivery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    notes TEXT,
    delivery_cost DECIMAL(10, 2),
    delivery_company_name VARCHAR(100),
    delivery_status VARCHAR(50),
    order_id INT,
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

-- Create invoice table
CREATE TABLE invoice (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_number VARCHAR(50),
    customer_name VARCHAR(100),
    customer_address VARCHAR(255),
    total_amount DECIMAL(10, 2),
    order_id INT,
    FOREIGN KEY (order_id) REFERENCES orders(id)
);
CREATE TABLE swapping (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    status VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

-- Insert some dummy data
INSERT INTO swapping (user_id, book_id, status) VALUES
(1, 101, 'Pending'),
(2, 102, 'Approved');

-- Dummy data
INSERT INTO user (name, email, creation_date, address, age, password) VALUES 
('John Doe', 'john@example.com', '2023-01-01', '123 Main St', 30, 'hashedpassword1'),
('Jane Smith', 'jane@example.com', '2023-02-01', '456 Elm St', 25, 'hashedpassword2');

INSERT INTO admin (username, password) VALUES 
('admin', 'password123');

INSERT INTO items (price, quantity_available, category, description) VALUES 
(10.99, 100, 'Fiction', 'A thrilling fiction novel'),
(15.99, 50, 'Non-Fiction', 'An insightful non-fiction book');

INSERT INTO offers (discount_percentage, start_date, end_date, user_id, items_id) VALUES 
(10.00, '2023-06-01', '2023-06-10', 1, 1);

INSERT INTO orders (date_placed, order_items, payment_status, shipping_method, user_id) VALUES 
('2023-05-01', 'Item1, Item2, 3', 'Completed', 'Standard', 1);

INSERT INTO delivery (notes, delivery_cost, delivery_company_name, delivery_status, order_id) VALUES 
('Handle with care', 5.99, 'Fast Delivery', 'Delivered', 1);

INSERT INTO invoice (invoice_number, customer_name, customer_address, total_amount, order_id) VALUES 
('INV12345', 'John Doe', '123 Main St', 16.98, 1);
