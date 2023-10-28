<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/payment.css">
    <title>Payment Page</title>
</head>
<body>
<?php 
    // connect db
    @ $db = new mysqli('localhost', 'root', '', 'movieverse_db');

    // check if post method
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get the value of the "clicked-box" input field
        $selectedSeat = $_POST["selected-seat"];
        $selectedTime = $_POST["selected-time"];
    }
    ?>
    <div>
        <img src="../public/paymentqr.png" alt="payment qr">
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
        </div>
        <form action="../html/success-payment.html">
            <button type="submit">Mark as paid</button>
        </form>
    </div>
</body>
</html>