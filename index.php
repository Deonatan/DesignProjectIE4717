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

    #Initialize Filter Value
    $sort_type = 'default';
    $requested_cinema = 'default';
    $requested_genre = 'default';
    $requested_status = 'default'; 
    #Get Filter Value if POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $sort_type = $_POST['sort-select'];
        $requested_cinema = $_POST['theatre-select'];
        $requested_genre = $_POST['selected-genres'];
        $requested_status = $_POST['selected-status'];
    }

    #Get All Movie Id
    $all_movie_id_query = "SELECT id FROM movie";
    $all_movie_id_result = $db->query($all_movie_id_query);
    $all_movie_id_arr = array();
    if ($all_movie_id_result) {
        while ($row = $all_movie_id_result->fetch_assoc()) {
            $all_movie_id_arr[] = $row['id'];
        }
    }

    #Get Showing Movie ID
    $showing_movie_id_query = "SELECT movie_id FROM movie_schedule";
    $showing_movie_id_result = $db->query($showing_movie_id_query);
    $showing_movie_id_arr = array();
    if ($showing_movie_id_result) {
        while ($row = $showing_movie_id_result->fetch_assoc()) {
            $showing_movie_id_arr[] = $row['movie_id'];
        }
    }

    // 1. SHOWING / COMING SOON FILTER
    if ($requested_status=='default'){
        $movie_id_str = implode(', ', $showing_movie_id_arr);
    }else{
        $movie_id_str = implode(', ', array_diff($all_movie_id_arr, $showing_movie_id_arr));
    }
    
    //2.CINEMA FILTER
    if ($requested_cinema != 'default' && $requested_status == 'default') {
        //GET MOVIE ID FROM REQUESTED CINEMA
        $movie_id_from_schedule = "SELECT movie_id FROM movie_schedule WHERE theatre_id IN($requested_cinema)";
        // Execute the SQL query
        $movie_id_from_schedule_result = $db->query($movie_id_from_schedule);
        // Initialize an array to store movie_id values
        $movie_id_from_schedule_arr = array();
        // Check if the query was successful
        if ($movie_id_from_schedule_result) {
            // Fetch and add movie_id values to the array
            while ($row = $movie_id_from_schedule_result->fetch_assoc()) {
                $movie_id_from_schedule_arr[] = $row['movie_id'];
            }
        }
        $movie_id_str = implode(', ', $movie_id_from_schedule_arr);
    }

    //3. GENRE FILTER
    $requested_genre_condition='default';
    $requested_genre_arr = array();
    if ($requested_genre!='default'){
        $requested_genre_arr = explode(',', $requested_genre); // Split the string into an array
        // Build the genre conditions
        $requested_genre_condition = [];
        foreach ($requested_genre_arr as $genre) {
            $requested_genre_condition[] = "genre LIKE '%" . trim($genre) . "%'";
        }
        // Combine the genre conditions with OR
        $requested_genre_condition = implode(' OR ', $requested_genre_condition);
    }

    //BUILD MOVIE QUERY
    $requested_movie_query = "SELECT * FROM movie WHERE id IN ($movie_id_str)";
    if ($requested_genre_condition!='default') {
        $requested_movie_query .= " AND ($requested_genre_condition)";
    }

    //4. Sort Type
    // Modify the query based on the selected sort type
    switch ($sort_type) {
        case 'alphabetical':
            $requested_movie_query .= " ORDER BY title ASC"; // Sort alphabetically by movie title
            break;
            case 'rating':
                $requested_movie_query .= " ORDER BY rating DESC"; // Sort by rating in descending order
                break;
                // For the 'default' case, you don't need to add an ORDER BY clause
            }
            
    // EXECUTE QUERY AND POPULATE DICT
    $requested_movie_result = $db->query($requested_movie_query);    
    $requested_movie_dict = array();
    $requested_movie_titles = array();
    if ($requested_movie_result){
        while ($row = $requested_movie_result->fetch_assoc()){
            $requested_movie_dict[$row['title']] = $row;
            $requested_movie_titles[] = $row['title'];
            
        }
    }
    ?>
    <custom-navbar type='parent'></custom-navbar>
    <div class='wrapper'>
    <table class='movie-list' border='0'>
        <tr>
                <td  colspan="4" class="filter-row">
                <form id='sort-form'
                method='POST' 
                action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class='filter-container'>
                    <div>
                        <input type="hidden" id="selected-status" name="selected-status" value="">
                        <button onclick="submitForm(this.value)" value='default' id='showing-button' class='dropbtn-genre'>Showing</button>
                        <button onclick="submitForm(this.value)" value='coming-soon' id='coming-soon-button' class='dropbtn-genre'>Coming Soon</button>
                    </div>
                    <div class="sort-select">
                    <label for="sort-select">Sort by: </label>
                    <select id="sort-select" name='sort-select'>
                        <option value="default" <?php if ($sort_type == 'default') echo 'selected'; ?>>Default</option>
                        <option value="alphabetical" <?php if ($sort_type == 'alphabetical') echo 'selected'; ?>>Alphabetical</option>
                        <option value="rating" <?php if ($sort_type == 'rating') echo 'selected'; ?>>Rating</option>
                    </select>
                    </div>
                    <div class="theatre-select">
                    <label for="theatre-select">Select Cinema: </label>
                    <select id="theatre-select" name='theatre-select'>
                        <option value="default" <?php if ($requested_cinema == 'default') echo 'selected'; ?>>All MovieVerse Cinema</option>
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
                            if ($requested_cinema == $theatre_id) {
                                echo 'selected';
                            }
                            echo '>' . $name . '</option>';
                        }
                        ?>
                    </select>
                    </div>
                    <?php
                    #Retrieve All Movie Genres to create checkbox
                    $genres_list_query = "SELECT GROUP_CONCAT(DISTINCT genre SEPARATOR ', ') AS genres FROM movie;";
                    $genres_list_result = $db->query($genres_list_query)->fetch_assoc();    
                    $genres_array = explode(', ', $genres_list_result['genres']);
                    $genres_array = array_unique($genres_array);
                    sort($genres_array);
                    // echo implode(', ', $genres_array);
                    ?>
                        <div class="dropdown-genre">
                        <button class="dropbtn-genre">Genre</button>
                            <div class="dropdown-genre-content">
                            <?php
                            // if (in_array('Action', $requested_genre_arr)){
                            //     echo "Found";
                            //   }
                            //   else {
                            //     echo "Not Found";
                            //   }
                            foreach ($genres_array as $genre) {
                                // Output a checkbox for each genre
                                $checked = in_array($genre, $requested_genre_arr) ? 'checked' : '';
                                echo '
                                <input type="checkbox" id="' . $genre . '" name="genres[]" value="' . $genre . '" ' . $checked . '>
                                <label for="' . $genre . '">' . $genre . '</label><br>';
                            }
                            ?>
                            <input type="hidden" id="selected-genres" name="selected-genres" value="">
                            </div>
                        </div>
                    <button type='submit' onclick="submitForm()" class='dropbtn-genre'>Search</button>
                </div>
                </form>
            </td>
        </tr>
    </table>
    <table class='movie-list' border="0">
        <?php
        $i = 0;
        while($i<count($requested_movie_dict)){
            $j=0;
            echo '<tr>';
            while($i<count($requested_movie_dict) && $j<3){
                echo '<td>';
                echo '<a href="php/movie_desc.php?id=' . $requested_movie_dict[$requested_movie_titles[$i]]['id'] . '">';
                echo '  <div class="movie-container">';
                echo '    <img class="movie-poster" src="'.$requested_movie_dict[$requested_movie_titles[$i]]['poster_link'].'" alt="oppenheimer-poster" style="width: 95%; height:80%;">';
                echo '    <div class="movie-info">';
                echo '      <span>' . $requested_movie_dict[$requested_movie_titles[$i]]['title'] . '</span><br>';
                echo '      <span>' . $requested_movie_dict[$requested_movie_titles[$i]]['genre'] . '</span><br>';
                echo '      <span>' . $requested_movie_dict[$requested_movie_titles[$i]]['rating'] . '</span><br>';
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
    </div>
  <custom-footer></custom-footer>
</body>
</html>
