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

        $query = "SELECT * FROM users WHERE username='".$username."' AND user_password='".$password."'";

        $response = mysqli_fetch_assoc($db->query($query));

        if ($response){
            session_start();
            $_SESSION["user_id"] = $response["id"];
            echo "<div class='wrapper'><div class='status-container'><h1>Login Successful!</h1><p>Welcome to movieverse!</p></div></div>";
        } else {
            echo "invalid";
        }
    ?>
</body> 
</html>