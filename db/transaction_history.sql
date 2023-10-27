CREATE TABLE transaction_history (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    schedule_id INT,
    payment_status VARCHAR(50),
);