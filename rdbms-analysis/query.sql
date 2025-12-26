DROP DATABASE IF EXISTS customer_orders;
CREATE DATABASE customer_orders;
USE customer_orders;

CREATE TABLE customers (
    customer_id INT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
);

CREATE TABLE orders (
    order_id INT PRIMARY KEY,
    customer_id INT,
    order_date DATE,
    amount DECIMAL(10,2),
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);

INSERT INTO customers VALUES
(1, 'Emma White', 'emma@example.com'),
(2, 'Bob Brown', 'bob@example.com'),
(3, 'John Doe', 'john@example.com'),
(4, 'Tom Green', 'tom@example.com'),
(5, 'Alice Blue', 'alice@example.com'),
(6, 'Liam Black', 'liam@example.com'),
(7, 'Jane Smith', 'jane@example.com'),
(8, 'Olivia Yellow', 'olivia@example.com');

INSERT INTO orders VALUES
(1, 1, '2023-07-01', 500.00),
(2, 2, '2023-08-15', 1200.75),
(3, 3, '2023-09-20', 1500.50),
(4, 4, '2023-10-05', 800.00),
(5, 5, '2023-11-22', 2200.25),
(6, 6, '2023-12-30', 900.00),
(7, 7, '2024-01-10', 3000.00),
(8, 8, '2024-02-17', 3500.00),
(9, 1, '2024-03-05', 450.00),
(10, 2, '2024-04-15', 1000.00),
(11, 3, '2024-05-21', 1300.00),
(12, 4, '2024-06-12', 1200.00),
(13, 5, '2024-07-08', 1800.00),
(14, 6, '2024-07-11', 900.00),
(15, 7, '2024-07-12', 9000.75),
(16, 8, '2024-07-12', 6000.00),
(17, 1, '2024-07-12', 1050.00),
(18, 2, '2024-07-12', 2500.00),
(19, 3, '2024-07-12', 1100.00),
(20, 4, '2024-07-12', 700.00),
(21, 5, '2024-07-12', 1200.00),
(22, 6, '2024-07-12', 800.00),
(23, 7, '2024-07-12', 1000.00),
(24, 8, '2024-07-12', 500.00);

CREATE INDEX idx_orders_customer_date ON orders(customer_id, order_date);

SELECT
    c.customer_id,
    c.name,
    c.email,
    SUM(o.amount) AS total_spent
FROM customers c
JOIN orders o ON c.customer_id = o.customer_id
WHERE o.order_date >= '2023-07-13'
GROUP BY c.customer_id, c.name, c.email
ORDER BY total_spent DESC
LIMIT 5;


