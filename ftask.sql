-- создание базы ---
mysql> mysql> CREATE TABLE orders (
    order_date DATE,
    order_id INT,
    user_id INT,
    price DECIMAL(10, 2)
);


--- insert value ---
INSERT INTO orders (order_date, order_id, user_id, price) VALUES
('2024-01-01', 1, 1, 5.00),
('2024-01-01', 2, 1, 10.00),
('2024-01-01', 3, 2, 5.00),
('2024-01-01', 4, 3, 5.00),
('2024-01-01', 5, 1, 5.00),
('2024-01-02', 6, 1, 5.00),
('2024-01-02', 7, 2, 10.00),
('2024-01-02', 8, 3, 5.00),
('2024-01-03', 9, 3, 5.00),
('2024-01-03', 10, 3, 5.00);


--- искомое выражение ---
SELECT 
    order_date AS "DATE",
    COUNT(order_id) AS "Количество заказов",
    (SELECT COUNT(*) FROM (SELECT DISTINCT user_id FROM orders o2 WHERE o2.order_date = o1.order_date) AS unique_users) AS "Количество покупателей",
    SUM(price) AS "Оборот"
FROM 
    orders o1
GROUP BY 
    order_date
ORDER BY 
    order_date;
