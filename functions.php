<?php
function getConnection() {
    try {
        $connection = new PDO("mysql:host=185.197.59.18;dbname=oertestdb",
            "chris", "Admin");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (Exception $e) {
        /* We should log the error to a file so the developer can look at any logs. However, for now we won't */
        throw new Exception("Connection error ". $e->getMessage(), 0, $e);
    }
}
function set_session($key, $value) {
    // Set key element = value
    $_SESSION[$key] = $value;
    return true;
}

function display_nav() {
    echo "<nav> <!-- This is the nav section that I will use to house my navbar. -->
    <ul class='topnav'> <!-- ul with class that will use css to style into navbar -->
        <li><a class='active' href='index.php'>Home</a></li>
        <li><a href='editRecordForm.php'>Edit Record</a></li>
        <li><a href='chooseRecordList.php'>Record List</a></li>
        <li><a href='orderRecordsForm.php'>Order Records</a></li>
        <li><a href='credits.php'>Credits</a></li>
    </ul>
</nav>";
}
?>
