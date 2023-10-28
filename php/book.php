<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/book.css">
    <script src="../js/book.js" type="text/javascript" defer></script>
</head>
<body>
    <?php
        
    ?>
    <div class="container">
        <div class="column movie-poster">
            <h2>Movie Poster</h2>
            <p>load image from db</p>
        </div>
        <div class="column theatre-layout">
            <div class="sub-container">
                <div class="time-schedule"></div>
                <div class="time-schedule"></div>
                <div class="time-schedule"></div>
                <div class="time-schedule"></div>
            </div>
            <div class="screen">Screen</div>
            <div class="book-form">
                <form id="grid-form" method="post" action="../php/payment.php" >
                    <input type="hidden" id="clicked-box" name="clicked-box" value="">
                    <div class="grid-container book-form">
                    </div>
                </form>
            </div>
            <div class="sub-container">
                <div class="details">
                    <p>Time: </p>
                    <p>Seats: </p>
                </div>
                <div class="payment">
                    <button class="payment-button">Confirm to payment</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
