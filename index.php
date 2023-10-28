<!DOCTYPE html>
<html>
<head>
    <title>Another Page</title>
    <script src="js/custom-navbar.js" type="text/javascript" defer></script>
    <script src="js/index.js" type="text/javascript" defer></script>
  <link href="css/index.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
    <?php
    // Create a database connection
    @ $db = new mysqli('localhost', 'root', '', 'movieverse_db');

    if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $sort_type = $_POST['sort-select'];
    }else{
        $sort_type = 'default';
    }

    $movie_list_query = "SELECT * FROM movie";
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
      <th colspan="3" class="sort-row">
        <div class="sort-select">
        <form id='sort-form'
        method='POST' onchange=submitForm()>
            <label for="sort-select">Sort by: </label>
            <select id="sort-select" name='sort-select'>
                <option value="default" <?php if ($sort_type == 'default') echo 'selected'; ?>>Default</option>
                <option value="alphabetical" <?php if ($sort_type == 'alphabetical') echo 'selected'; ?>>Alphabetical</option>
                <option value="rating" <?php if ($sort_type == 'rating') echo 'selected'; ?>>Rating</option>
            </select>
        </form>
        </div>
      </th>
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
</body>
</html>
