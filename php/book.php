<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/book.css">
    <script src="../js/book.js" type="text/javascript" defer></script>
</head>
<body>
    <?php
        // connect db
        @ $db = new mysqli('localhost', 'root', '', 'movieverse_db');

        // retrieve from req
        $movie_id = 1;

        //get movie details
        $get_details = "SELECT * FROM movie WHERE id=".$movie_id;
        // get movie schedule
        $get_schedule_query = "SELECT * FROM movie_schedule WHERE movie_id=".$movie_id;

        $movie_details = mysqli_fetch_assoc($db->query($get_details));
        $result = $db->query($get_schedule_query);
        $movie_schedules = array();
        while ($row = $result->fetch_assoc()) {
            $movie_schedules[] = $row;
        }

    ?>
    <div class="container">
        <div class="column movie-poster">
            <img src="<?php echo $movie_details["poster_link"]?>">
            
        </div>
        <div class="column theatre-layout">
            <div class="sub-container">
                <div class = time-schedule-container>
                <?php
                    foreach ($movie_schedules as $schedule){
                        $start_time = substr($schedule['start_time'],0,5);
                        $end_time = substr($schedule['end_time'],0,5);
                        if (empty($start_time)) {
                            continue; 
                        }
                        echo "<div id=$start_time-$end_time class='time-schedule'>$start_time-$end_time</div>";
                    }
                ?>
                </div>
            </div>
            <div class="screen">Screen</div>
            <div class="book-form">
                <form id="grid-form" method="post" action="../php/payment.php" >
                    <input type="hidden" id="selected-seat" name="selected-seat" value="">
                    <input type="hidden" id="selected-time" name="selected-time" value="">
                    <div class="grid-container book-form">
                    </div>
                </form>
            </div>
            <div class="sub-container">
                <div class="details">
                    <p id="display-time">Time: </p>
                    <p id="display-seat">Seat: </p>
                </div>
                <div class="payment">
                    <button class="payment-button">Confirm to payment</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
