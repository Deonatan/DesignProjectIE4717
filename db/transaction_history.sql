CREATE TABLE transaction_history (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    schedule_id INT,
    selected_seat VARCHAR(100),
    payment_status VARCHAR(50)
);