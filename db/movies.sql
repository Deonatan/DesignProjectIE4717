CREATE TABLE movie (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR (100) NOT NULL,
    rating DECIMAL(3,1),
    cast VARCHAR(100) NOT NULL,
    director VARCHAR(50) NOT NULL,
    genre VARCHAR(50) NOT NULL,
    release_date datetime NOT NULL,
    running_time int UNSIGNED NOT NULL,
    language VARCHAR(50) NOT NULL,
    synopsis VARCHAR(500) NOT NULL
)