<!DOCTYPE html>
<html>
<head>
    <title>Enquiry Page</title>
    <script src="../js/custom-navbar.js" type="text/javascript" defer></script>
    <script src="../js/custom-footer.js" type="text/javascript" defer></script>
    <link href="../css/enquiry.css" rel="stylesheet" type="text/css" media="all">
    <link href="../css/global.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
<?php
    // Check if the form was submitted
    $_SESSION["redirect_url"] = $_SERVER["REQUEST_URI"];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $enquiry = $_POST["enquiry"];

        // Create a database connection
        @$db = new mysqli('localhost', 'root', '', 'movieverse_db');

        if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
        }

        // Insert data into the database
        $insert_query = "INSERT INTO enquiries (name, email, enquiry) VALUES ('$name', '$email', '$enquiry')";

        if ($db->query($insert_query) === TRUE) {
            echo '<script>alert("Enquiry submitted successfully.");</script>';
        } else {
            echo "Error: " . $insert_query . "<br>" . $db->error;
        }
    }
    ?>
    <custom-navbar type="child"></custom-navbar>
    <div class="wrapper">
    <h1>Contact Us</h1>
    <p>Please feel free to submit your enquiry:</p>
    <form action="enquiry.php" method="POST">
        <table>
            <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" name="name" id="name" class='input-sizing1' required></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" name="email" id="email" class='input-sizing1' required></td>
            </tr>
            <tr>
                <td><label for="enquiry">Enquiry:</label></td>
                <td><textarea name="enquiry" id="enquiry" rows="4" required class='input-sizing2'></textarea></td>
            </tr>
            <tr>
                <td></td> <!-- Empty cell for spacing -->
                <td><input class='submit-button' type="submit" value="Submit"></td>
            </tr>
        </table>
    </form>
    </div>
    <custom-footer></custom-footer>
</body>
</html>
