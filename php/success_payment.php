<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/success_payment.css">
    <script src="../js/custom-navbar.js" type="text/javascript" ></script>
</head>
<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // connect db
            @ $db = new mysqli('localhost', 'root', '', 'movieverse_db');
            // Get the value of the "clicked-box" input field
            $selected_seat = $_POST["selected_seat"];
            $selected_time = explode("-",$_POST["selected_time"]);
            $start_time = $selected_time[0].":00";
            $end_time = $selected_time[1].":00";
            $total_price = $_POST["total_price"];
            $movie_id = $_POST["movie_id"];
            session_start();
            $user_id = $_SESSION["user_id"];
            $get_schedule_id_query = "SELECT id FROM movie_schedule WHERE movie_id=$movie_id AND start_time='$start_time' AND end_time='$end_time'";
            $schedule_id = mysqli_fetch_assoc($db->query($get_schedule_id_query))["id"];
            $insert_query = "INSERT INTO transaction_history (user_id, schedule_id,selected_seat, payment_status) VALUES ($user_id, $schedule_id, '$selected_seat','Successful')";
            $db->query($insert_query);
        }
    ?>
    <custom-navbar type="child"/>
    <div class="background-wrapper">
        <div class="container">
            <h1>Payment Successful!</h1>
            <p>Your payment has been successfully processed.</p>
            <p>Thank you for your purchase!</p>
        </div>
    </div>
</body>
</html>
