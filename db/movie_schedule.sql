CREATE TABLE movie_schedule (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    theatre_id INT,
    start_time TIME,
    end_time TIME,
    price FLOAT,
)