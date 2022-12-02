<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Student Query</title>
</head>
<body>
<h1>Students</h1>
<?php
include 'database_conn.php';      // make db connection

$sql = "SELECT studentid, forename, surname, coursecode, stage, email FROM srs_student";
$queryResult = $dbConn->query($sql);
if($queryResult === false) {
    echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
    exit;
}
else {
    while($rowObj = $queryResult->fetch_object()){
        echo "<div>
				{$rowObj->studentid}, {$rowObj->forename}, {$rowObj->surname},
				{$rowObj->coursecode}, {$rowObj->stage} , {$rowObj->email}
		</div>\n";
    }
}
$queryResult->close();
$dbConn->close();
?>

</body>
</html>
