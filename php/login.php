<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/auth.css">
    <script src="../js/custom-navbar.js" type="text/javascript" ></script>
    <title>Registration Status</title>
</head>
<body>
    <custom-navbar type="child"/>
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
            $redirect_url = isset($_SESSION["redirect_url"]) ? $_SESSION["redirect_url"] : "../index.php";
            echo '<script>
            setTimeout(function() {
                window.location.href = "' . $redirect_url . '"; 
            }, 1000); 
        </script>';
        } else {
            echo "invalid";
        }
    exit;
    ?>
</body> 
</html>