<?php
$dbConn = new mysqli('localhost', 'unn_w16004894', 'RDQZNTM3', 'unn_w16004894');

if ($dbConn->connect_error) {
    echo "<p>Connection failed: ".$dbConn->connect_error."</p>\n";
    exit;
}
?>
