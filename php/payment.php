<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/payment.css">
    <script src="../js/custom-navbar.js" type="text/javascript" ></script>
    <title>Payment Page</title>
</head>
<body>
<?php 
    session_start();
    if (!isset($_SESSION["user_id"])) {
        // User is not logged in, redirect to the login page or show an access denied message.
        header("Location: ../html/login.html");
        exit();
    }
    // connect db
    @ $db = new mysqli('localhost', 'root', '', 'movieverse_db');

    // check if post method
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get the value of the "clicked-box" input field
        $selectedSeat = $_POST["seat-form"];
        $selectedTime = $_POST["time-form"];
        $totlaPrice = $_POST["price-form"];
        $movieId = $_POST["movie-id"];
    }
    ?>
    <custom-navbar type="child"></custom-navbar>
    <div class="background">
        <img src="../public/paymentqr.png" class="qr-code" alt="payment qr">
        <br>
        <div class="receipt">
            <div class="header">
                Order Confirmation
            </div>
            <div class="item">
                <div class="description">Selected time:</div>
                <div class="detail"><?php echo $selectedTime?></div>
            </div>
            <div class="item">
                <div class="description">Selected seat:</div>
                <div class="detail"><?php echo $selectedSeat?></div>
            </div>
            <div class="item">
                <div class="description">Total Price:</div>
                <div class="detail">$<?php echo $totlaPrice?></div>
            </div>
        </div>
        <form action="../php/success_payment.php" method="post">
            <button type="submit">Mark as paid</button>
            <input type="hidden" name="movie_id" value="<?php echo $movieId?>">
            <input type="hidden" name="selected_time" value="<?php echo $selectedTime?>">
            <input type="hidden" name="selected_seat" value="<?php echo $selectedSeat?>">
            <input type="hidden" name="total_price" value="<?php echo $totlaPrice?>">
        </form>
    </div>
</body>
</html>