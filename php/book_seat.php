<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/book_seat.css">
    <link href="../css/global.css" rel="stylesheet" type="text/css" media="all">
    <script src="../js/book_seat.js" type="text/javascript" defer></script>
    <script src="../js/custom-navbar.js" type="text/javascript" ></script>
    <script src="../js/custom-footer.js" type="text/javascript" defer></script>
    <title>Movie Seat Booking</title>
</head>
<body>
    <custom-navbar type="child"/>
    <div class="body-wrapper">
    <?php
        // connect db
        @ $db = new mysqli('localhost', 'root', '', 'movieverse_db');

        // retrieve from req
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            $movie_id = $_GET['movie_id'];
        }

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
    <form id="grid-form" method="post" action="../php/payment.php" >
        <input type="hidden" name="movie-id" value="<?php echo $movie_id?>">
        <input type="hidden" id="seat-form" name="seat-form" value="">
        <input type="hidden" id="time-form" name="time-form" value="">
        <input type="hidden" id="total-price" name="price-form" value="">
    </form>
    <div class="movie-container">
        <h1 class='title'><?php echo $movie_details["title"];?></h1>
        <label>Selected Time:</label>
        <select id="selected-time">
        <?php
            foreach ($movie_schedules as $schedule){
                $start_time = substr($schedule['start_time'],0,5);
                $end_time = substr($schedule['end_time'],0,5);
                $price = $schedule['price'];
                $schedule_id = $schedule['id'];
                $get_occupied_seat_query = "SELECT * FROM transaction_history WHERE schedule_id=$schedule_id";
                $raw_seat_data = $db->query($get_occupied_seat_query);
                $occupied_seats = "";
                while ($row = $raw_seat_data->fetch_assoc()){
                    $occupied_seats .= ",".$row["selected_seat"];
                }
                echo "<option value='$price%$start_time-$end_time%$occupied_seats'>$start_time-$end_time </option>";
            }
        ?>
        </select>
    </div>

    <ul class="showcase">
        <li>
            <div class="seat"></div>
            <small>N/A</small>
        </li>
        <li>
            <div class="seat selected"></div>
            <small>Selected</small>
        </li>
        <li>
            <div class="seat occupied"></div>
            <small>Occupied</small>
        </li>
    </ul>

    <div class="container">
        <div class="movie-screen">
            <img src='../public/screen.png' alt='screen' />
        </div>

        <div class="row-container">
            <div class="row">
                <div class="seat">A1</div>
                <div class="seat">A2</div>
                <div class="seat">A3</div>
                <div class="seat">A4</div>
                <div class="seat">A5</div>
                <div class="seat">A6</div>
                <div class="seat">A7</div>
                <div class="seat">A8</div>
            </div>
            <div class="row">
                <div class="seat">B1</div>
                <div class="seat">B2</div>
                <div class="seat">B3</div>
                <div class="seat ">B4</div>
                <div class="seat ">B5</div>
                <div class="seat">B6</div>
                <div class="seat">B7</div>
                <div class="seat">B8</div>
            </div>
            <div class="row">
                <div class="seat">C1</div>
                <div class="seat">C2</div>
                <div class="seat">C3</div>
                <div class="seat">C4</div>
                <div class="seat">C5</div>
                <div class="seat">C6</div>
                <div class="seat ">C7</div>
                <div class="seat ">C8</div>
            </div>
            <div class="row">
                <div class="seat">D1</div>
                <div class="seat">D2</div>
                <div class="seat">D3</div>
                <div class="seat">D4</div>
                <div class="seat">D5</div>
                <div class="seat">D6</div>
                <div class="seat">D7</div>
                <div class="seat">D8</div>
            </div>
            <div class="row">
                <div class="seat">E1</div>
                <div class="seat">E2</div>
                <div class="seat ">E3</div>
                <div class="seat ">E4</div>
                <div class="seat">E5</div>
                <div class="seat">E6</div>
                <div class="seat">E7</div>
                <div class="seat">E8</div>
            </div>
            <h5 class='subtitle'>FAMILY</h5>
            <div class="row">
                <div class="seat couple-seat">F1</div>
                <div class="seat couple-seat">F2</div>
                <div class="seat couple-seat">F3</div>
                <div class="seat couple-seat">F4</div>
                <div class="seat couple-seat">F5</div>
                <div class="seat couple-seat">F6</div>
                <div class="seat couple-seat">F7</div>
                <div class="seat couple-seat">F8</div>
            </div>
            <div class="row">
                <div class="seat couple-seat">G1</div>
                <div class="seat couple-seat">G2</div>
                <div class="seat couple-seat">G3</div>
                <div class="seat couple-seat">G4</div>
                <div class="seat couple-seat">G5</div>
                <div class="seat couple-seat ">G6</div>
                <div class="seat couple-seat ">G7</div>
                <div class="seat couple-seat">G8</div>
            </div>
            <div class="row">
                <div class="seat couple-seat">H1</div>
                <div class="seat couple-seat">H2</div>
                <div class="seat couple-seat">H3</div>
                <div class="seat couple-seat">H4</div>
                <div class="seat couple-seat">H5</div>
                <div class="seat couple-seat">H6</div>
                <div class="seat couple-seat">H7</div>
                <div class="seat couple-seat">H8</div>
            </div>
            <h5 class='subtitle'>COUPLE</h5>

            <div class="text-wrapper">
                <p class="text">Selected Seats <span id='count'>0</span>
                    <p class="text">Total Price $<span id="total">0</span></p>
            </div>
            <div class="payment">
                <button class="payment-button">Confirm to payment</button>
            </div>
        </div>
    </div>
    </div>
    <custom-footer></custom-footer>
</body>
</html>
