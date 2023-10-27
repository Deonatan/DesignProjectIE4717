<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../css/movie_desc.css" rel="stylesheet" type="text/css" media="all">
    <script type="text/javascript" src="../js/movie_desc.js"></script>
</head>
<body>
    <?php
    // Create a database connection
    @ $db = new mysqli('localhost', 'root', '', 'movieverse_db');

    if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
    }

    $movie_query = "SELECT * FROM movie WHERE title like 'Oppenheimer'";
    $movie_result = ($db->query($movie_query));
    $items = array(); // Initialize an empty array to store the movie details

    if ($movie_result) {
        while ($row = mysqli_fetch_assoc($movie_result)) {
            // Assign the retrieved values to the items array
            $items["title"] = $row["title"];
            $items["rating"] = $row["rating"];
            $items["cast"] = $row["cast"];
            $items["director"] = $row["director"];
            $items["genre"] = $row["genre"];
            $items["release_date"] = $row["release_date"];
            $items["running_time"] = $row["running_time"];
            $items["language"] = $row["language"];
            $items["synopsis"] = $row["synopsis"];
        }
    }

    // foreach ($items as $key => $value) {
    //     echo $key . ": " . $value . "<br>";
    // }    

    ?>
    <div class="movie-container">
        <div class="movie-components">
            <div class="movie-poster">
                <img src="../public/oppenheimer-poster.jpg" style="height:500px;">
            </div>
            <div class="movie-info">
                    <strong>Details</strong><br>
                    <div class="movie-details">
                        <div class="details-left">
                            <span>Rating: <?php echo $items['rating'] ?></span><br>
                            <span>Cast: <?php echo $items['cast'] ?></span><br>
                            <span>Director: <?php echo $items['director'] ?></span><br>
                            <span>Genre: <?php echo $items['genre'] ?></span><br>
                        </div>
                        <div class="details-right">
                            <span>Release Date: <?php echo $items['release_date'] ?></span><br>
                            <span>Running Time: <?php echo $items['running_time'] ?></span><br>
                            <span>Language: <?php echo $items['language'] ?></span><br>
                        </div>
                    </div><br>
                    <strong>Synopsis</strong><br>
                    <span><?php echo $items['synopsis'] ?></span>
                    <div class="book-now-container">
                        <button class="book-now-button">Book Now</button>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>