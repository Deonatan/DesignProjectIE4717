<!DOCTYPE html>
<html>
<head>
  <title>Transaction History</title>
  <script src="../js/custom-navbar.js" type="text/javascript" defer></script>
    <script src="../js/custom-footer.js" type="text/javascript" defer></script>
    <link href="../css/transaction_history.css" rel="stylesheet" type="text/css" media="all">
    <link href="../css/global.css" rel="stylesheet" type="text/css" media="all">

</head>
<body>
    <?php
    // Create a database connection
    @ $db = new mysqli('localhost', 'root', '', 'movieverse_db');

    if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
    }

    $requested_userid = 1;
    $transaction_history_query = "SELECT u.username AS 'Username',
    mt.title AS 'Movie Title',
    CONCAT(ms.start_time, ' - ', ms.end_time) AS 'Playing Time',
    th.selected_seat AS 'Selected Seat',
    th.payment_status AS 'Payment Status'
    FROM transaction_history th
    JOIN users u ON th.user_id = u.id
    JOIN movie_schedule ms ON th.schedule_id = ms.id
    JOIN movie mt ON ms.movie_id = mt.id
    WHERE th.user_id = 1;
    ";

    $result = $db->query($transaction_history_query);

    $movie_data = array(); // Initialize an empty dictionary

    $movie_data = array(); // Initialize an empty dictionary
    $movie_titles = array(); // Initialize an empty array to store all movie titles
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $movie_title = $row['Movie Title'];
            
            if (!in_array($movie_title, $movie_titles)) {
                // If the movie title is not already in the array, add it
                $movie_titles[] = $movie_title;
            }
    
            if (!array_key_exists($movie_title, $movie_data)) {
                // If the movie title is not already a key in the dictionary, create an empty array
                $movie_data[$movie_title] = array();
            }
            // Append the details to the array for the specific movie title
            $movie_data[$movie_title][] = array(
                'Username' => $row['Username'],
                'Playing Time' => $row['Playing Time'],
                'Selected Seat' => $row['Selected Seat'],
                'Payment Status' => $row['Payment Status']
            );
        }
    }

    ?>
    <custom-navbar type='child'></custom-navbar>
    <div class='container'>
    <table class='transaction-history-table' border="1">
        <tr class=''>
            <td>Username</td>
            <td>Movie Title</td>
            <td>Playing Time</td>
            <td>Selected Seat</td>
            <td>Payment Status</td>
        </tr>
        <?php
        foreach ($movie_titles as $movie_title) {
            if (array_key_exists($movie_title, $movie_data)) {
                foreach ($movie_data[$movie_title] as $details) {
                    echo '<tr>';
                    echo '<td>' . $details['Username'] . '</td>';
                    echo '<td>' . $movie_title . '</td>';
                    echo '<td>' . $details['Playing Time'] . '</td>';
                    echo '<td>' . $details['Selected Seat'] . '</td>';
                    echo '<td>' . $details['Payment Status'] . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5">Movie title not found in data: ' . $movie_title . '</td></tr>';
            }
        }
        ?>
    </table>
    </div>
    <custom-footer></custom-footer>
</body>
</html>


