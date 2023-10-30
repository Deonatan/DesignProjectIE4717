<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <script src="js/custom-navbar.js" type="text/javascript" defer></script>
    <script src="js/custom-footer.js" type="text/javascript" defer></script>
    <script src="js/index.js" type="text/javascript" defer></script>
    <link href="css/index.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/global.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
    <?php
    // Create a database connection
    @ $db = new mysqli('localhost', 'root', '', 'movieverse_db');

    if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
    }

    #Get Selected Sorting Method
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $sort_type = $_POST['sort-select'];
        $selected_theatre = $_POST['theatre-select'];
    }else{
        $sort_type = 'default';
        $selected_theatre = 'all';
    }

    #Retrieve Showing Movies Based of Selected Theatre
    $showing_movie_id_query = "SELECT movie_id FROM movie_schedule";
    if ($selected_theatre != 'all') {
        // If a specific theater is selected, add a WHERE clause to filter by theatre_id
        $showing_movie_id_query .= " WHERE theatre_id = " . intval($selected_theatre); // Ensure $selected_theatre is properly sanitized.
    }
    $showing_movie_id_result = $db->query($showing_movie_id_query);
    if ($showing_movie_id_result) {
        $movie_ids = array(); // Create an array to store the movie IDs
        while ($row = $showing_movie_id_result->fetch_assoc()) {
            $movie_ids[] = $row['movie_id'];
        }
    }

    // Convert the array of movie IDs to a comma-separated string
    $movie_id_list = implode(', ', $movie_ids);

    #Query Movie based on showing movies 
    $movie_list_query = "SELECT * FROM movie WHERE id IN ($movie_id_list)";
    // Modify the query based on the selected sort type
    switch ($sort_type) {
        case 'alphabetical':
            $movie_list_query .= " ORDER BY title ASC"; // Sort alphabetically by movie title
            break;
        case 'rating':
            $movie_list_query .= " ORDER BY rating DESC"; // Sort by rating in descending order
            break;
        // For the 'default' case, you don't need to add an ORDER BY clause
    }


    $movie_list_result = $db->query($movie_list_query);
    $movie_dict = array();
    $titles = array();
    if ($movie_list_result){
        while ($row = $movie_list_result->fetch_assoc()){
            $movie_dict[$row['title']] = $row;
            $titles[] = $row['title'];
        }
    }
    ?>
    <custom-navbar></custom-navbar>
    <table class='movie-list' border="0">
        <tr>
            <td  colspan="2" class="filter-row">
            <form id='sort-form'
            method='POST' onchange="submitForm()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class='filter-container'>
                <div class="sort-select">
                <label for="sort-select">Sort by: </label>
                <select id="sort-select" name='sort-select'>
                    <option value="default" <?php if ($sort_type == 'default') echo 'selected'; ?>>Default</option>
                    <option value="alphabetical" <?php if ($sort_type == 'alphabetical') echo 'selected'; ?>>Alphabetical</option>
                    <option value="rating" <?php if ($sort_type == 'rating') echo 'selected'; ?>>Rating</option>
                </select>
                </div>
                <div class="theatre-select">
                <label for="theatre-select">Select Theatre: </label>
                <select id="theatre-select" name='theatre-select'>
                    <option value="all" <?php if ($selected_theatre == 'all') echo 'selected'; ?>>All MovieVerse Cinema</option>
                    <?php
                    $theatre_list_query = "SELECT * FROM theatre" ;
                    $theatre_list_result = $db->query($theatre_list_query);
                    $theatre_dict = array();
                    $theatre_name = array();
                    if ($theatre_list_result){
                        while ($row = $theatre_list_result->fetch_assoc()){
                            $theatre_dict[$row['name']] = $row;
                            $theatre_name[] = $row['name'];
                        }
                    }
                    foreach ($theatre_name as $name) {
                        $theatre_id = $theatre_dict[$name]['id']; // Get the theater ID from the $theatre_dict array
                        echo '<option value="' . $theatre_id . '" ';
                        if ($selected_theatre == $theatre_id) {
                            echo 'selected';
                        }
                        echo '>' . $name . '</option>';
                    }
                    ?>
                </select>
            </div>
            </div>
            </form>
        </td>
    </tr>
        <?php
        $i = 0;
        while($i<count($movie_dict)){
            $j=0;
            echo '<tr>';
            while($i<count($movie_dict) && $j<3){
                echo '<td>';
                echo '<a href="php/movie_desc.php?id=' . $movie_dict[$titles[$i]]['id'] . '">';
                echo '  <div class="movie-container">';
                echo '    <img class="movie-poster" src="'.$movie_dict[$titles[$i]]['poster_link'].'" alt="oppenheimer-poster" style="width: 95%; height:80%;">';
                echo '    <div class="movie-info">';
                echo '      <span>' . $movie_dict[$titles[$i]]['title'] . '</span><br>';
                echo '      <span>' . $movie_dict[$titles[$i]]['genre'] . '</span><br>';
                echo '      <span>' . $movie_dict[$titles[$i]]['rating'] . '</span><br>';
                echo '    </div>';
                echo '  </div>';
                echo '</a>';
                echo '</td>';
                $i+=1;
                $j+=1;
            }
            echo '</tr>';
        }
        ?>
  </table>
  <custom-footer></custom-footer>
</body>
</html>
