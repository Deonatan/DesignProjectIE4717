<!DOCTYPE html>
<html>
<head>
  <title>Theatre List</title>
  <script src="../js/custom-navbar.js" type="text/javascript" defer></script>
    <script src="../js/theatre.js" type="text/javascript" defer></script>
    <script src="../js/custom-footer.js" type="text/javascript" defer></script>
    <link href="../css/theatre.css" rel="stylesheet" type="text/css" media="all">
    <link href="../css/global.css" rel="stylesheet" type="text/css" media="all">

</head>
<body>
    <?php
    // Create a database connection
    @ $db = new mysqli('localhost', 'root', '', 'movieverse_db');

    if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
    }

    $theatre_list_query = "SELECT * FROM theatre";
    $theatre_list_result = $db->query($theatre_list_query);
    $theatre_dict = array();
    $theatre_name = array();
    if ($theatre_list_result){
        while ($row = $theatre_list_result->fetch_assoc()){
            $theatre_dict[$row['name']] = $row;
            $theatre_name[] = $row['name'];
        }
    }

    ?>
    <custom-navbar></custom-navbar>
    <div class='container'>
    <form id="theatre-form" method="POST" action="../index.php">
    <input type="hidden" name="theatre-select" id='theatre-select-input' value="">
    <input type="hidden" name="sort-select"  id ='sort-select-input' value="">
    <table class='theatre-table' border="1">
        <tr class='centered-text'>
            <td>Theatre Name</td>
            <td>Location</td>
        </tr>
        <?php
        foreach ($theatre_dict as $theatre) {
            echo '<tr class="theatre-row">';
            echo '<td onclick=submitForm(' . $theatre['id'] . ')>' . $theatre['name'] . '</td>';
            echo '<td onclick=submitForm(' . $theatre['id'] . ')>' . $theatre['location'] . '</td>';
            echo '</tr>';
    }
        ?>
    </table>
    </form>
    </div>
    <custom-footer></custom-footer>
</body>
</html>


