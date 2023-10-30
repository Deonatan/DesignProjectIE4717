<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../css/movie_desc.css" rel="stylesheet" type="text/css" media="all">
    <link href="../css/global.css" rel="stylesheet" type="text/css" media="all">
    <script src="../js/custom-navbar.js" type="text/javascript" defer></script>
    <script src="../js/custom-footer.js" type="text/javascript" defer></script>
</head>
<body>
    <custom-navbar></custom-navbar>
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

    //Get Playing At info
    $theatre_id_query = "SELECT theatre_id FROM movie_schedule WHERE movie_id=$requested_id;";
    $theatre_id_result = $db->query($theatre_id_query);
    if ($theatre_id_result) {
        $theatre_ids = array(); // Create an array to store the movie IDs
        while ($row = $theatre_id_result->fetch_assoc()) {
            $theatre_ids[] = $row['theatre_id'];
        }
    }

    // Convert the array of movie IDs to a comma-separated string
    $theatre_id_list = implode(', ', $theatre_ids);

    //Get Theatre Names
    $theatre_name_query = "SELECT name FROM theatre WHERE id IN ($theatre_id_list)";
    $theatre_name_result = $db->query($theatre_name_query);
    $theatreNames = array(); // Create an array to store the theatre names
    while ($row = $theatre_name_result->fetch_assoc()) {
        $theatreNames[] = $row['name']; // Add each name to the array
    }

    // Convert the array to a comma-separated string
    $theatreNamesString = implode(', ', $theatreNames);

    // foreach ($items as $key => $value) {
    //     echo $key . ": " . $value . "<br>";
    // } 
    ?>
    <div class="movie-container">
        <div class="movie-components">
            <div class="movie-poster">
            <img src="<?php echo '../' . $movie_data['poster_link']; ?>" style="height:500px;">
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
                    <span><?php echo $movie_data['synopsis']?></span><br><br>
                    <strong>Playing At</strong><br>
                    <span><?php echo $theatreNamesString ?></span>
                    <div class="book-now-container">
                        <a href="book.php?movie_id=<?php echo $requested_id; ?>" class="book-now-button">Book Now</a>
                    </div>
            </div>
        </div>
    </div>
    <custom-footer></custom-footer>
</body>
</html>