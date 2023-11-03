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
    <custom-navbar type='child'></custom-navbar>
    <div class='wrapper'>
    <?php
    session_start();
    $_SESSION["redirect_url"] = $_SERVER["REQUEST_URI"];
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

    //GET SHOWING MOVIE ID
    #Get Showing Movie ID
    $showing_movie_id_query = "SELECT movie_id FROM movie_schedule";
    $showing_movie_id_result = $db->query($showing_movie_id_query);
    $showing_movie_id_arr = array();
    if ($showing_movie_id_result) {
        while ($row = $showing_movie_id_result->fetch_assoc()) {
            $showing_movie_id_arr[] = $row['movie_id'];
        }
    }

    if (!empty($theatre_ids)) {
        // Convert the array of movie IDs to a comma-separated string
        $theatre_id_list = implode(', ', $theatre_ids);
    
        // Get Theatre Names
        $theatre_name_query = "SELECT name FROM theatre WHERE id IN ($theatre_id_list)";
        $theatre_name_result = $db->query($theatre_name_query);
        $theatreNames = array(); // Create an array to store the theatre names
        while ($row = $theatre_name_result->fetch_assoc()) {
            $theatreNames[] = $row['name']; // Add each name to the array
            $theatreNamesString = implode(', ', $theatreNames);
        }
    } else {
        // Handle the case when $theatre_ids is empty (no need to search for theatre names)
        $theatreNamesString = 'Coming Soon'; // Initialize an empty array or handle it as needed
    }

    // Convert the array to a comma-separated string

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
                    <span><?php echo $theatreNamesString ?></span><br><br>
                    <?php
                    if (!in_array($requested_id, $showing_movie_id_arr)) {
                        // Movie is not showing, so hide the "Book Now" button
                    } else {
                        // Movie is showing, display the "Book Now" button
                        echo '<a href="book_seat.php?movie_id=' . $requested_id . '" class="book-now-button">Book Now</a>';
                    }
                    ?>
            </div>
        </div>
    </div>
    </div>
    <custom-footer></custom-footer>
</body>
</html>