<?php 
session_start();
session_destroy(); 
echo '<script>
if (typeof(Storage) !== "undefined") {
    localStorage.clear();
    console.log("localStorage cleared");
} else {
    console.log("localStorage is not supported.");
}
</script>';
$redirect_url = isset($_SESSION["redirect_url"]) ? $_SESSION["redirect_url"] : "../index.php";
header("Location: " . $redirect_url);
exit;
?>