<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/auth.css">
    <title>Registration Status</title>
</head>
<body>
    <?php
        // connect db
        @ $db = new mysqli('localhost', 'root', '', 'movieverse_db');
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];

        $insertQuery = "INSERT INTO users (username, email, user_password) VALUES ('$username','$email', '$password')";

        if ($db->query($insertQuery) === TRUE) {
            echo "<div class='wrapper'><div class='status-container'><h1>Registration Successful!</h1><p>Your have successfully registered.</p><p>Welcome to movieverse!</p></div></div>";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $db->error;
        }
    ?>
</body> 
</html>