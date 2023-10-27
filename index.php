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

    $movie_list_query = "SELECT * FROM movie";
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
          <label for="sort-select">Sort by: </label>
          <select id="sort-select">
              <option value="default">Default</option>
              <option value="alphabetical">Alphabetical</option>
              <option value="rating">Rating</option>
          </select>
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
                echo '<a href="php/movie_desc.php?title=' . $movie_dict[$titles[$i]]['title'] . '">';
                echo '  <div class="movie-container">';
                echo '    <img class="movie-poster" src="'.$movie_dict[$titles[$i]]['poster_link'].'" alt="oppenheimer-poster" style="width: 95%; height: auto;">';
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
