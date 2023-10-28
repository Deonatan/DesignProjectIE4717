<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../css/movie_desc.css" rel="stylesheet" type="text/css" media="all">
    <!-- <script type="text/javascript" src="../js/movie_desc.js"></script> -->
</head>
<body>
    <?php
    // Create a database connection
    @ $db = new mysqli('localhost', 'root', '', 'movieverse_db');

    if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
    }
    $requested_id = $_GET['id'];
    $movie_query = "SELECT * FROM movie WHERE id like '$requested_id'";
    $movie_data = $db->query($movie_query)->fetch_assoc();
    // foreach ($items as $key => $value) {
    //     echo $key . ": " . $value . "<br>";
    // } 
    ?>
    <div class="movie-container">
        <div class="movie-components">
            <div class="movie-poster">
                <img src=<?php echo $movie_data['poster_link']?> style="height:500px;">
            </div>
            <div class="movie-info">
                    <strong>Details</strong><br>
                    <div class="movie-details">
                        <div class="details-left">
                            <span>Rating: <?php echo $movie_data['rating']?></span><br>
                            <span>Cast: <?php echo $movie_data['cast']?></span><br>
                            <span>Director: <?php echo $movie_data['director']?></span><br>
                            <span>Genre: <?php echo $movie_data['genre']?></span><br>
                        </div>
                        <div class="details-right">
                            <span>Release Date: <?php echo $movie_data['release_date']?></span><br>
                            <span>Running Time: <?php echo $movie_data['running_time']?></span><br>
                            <span>Language: <?php echo $movie_data['language']?></span><br>
                        </div>
                    </div><br>
                    <strong>Synopsis</strong><br>
                    <span><?php echo $movie_data['synopsis']?></span>
                    <div class="book-now-container">
                        <a href="book.php?movie_id=<?php echo $requested_id; ?>" class="book-now-button">Book Now</a>
                    </div>

            </div>
        </div>
    </div>
</body>
</html>