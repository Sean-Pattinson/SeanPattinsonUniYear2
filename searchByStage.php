<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Student Stage</title>
</head>
<body>
<h1>Students</h1>
<?php
include 'database_conn.php';      // make db connection

$stage = isset($_REQUEST['stage']) ? $_REQUEST['stage'] : null;
$sql = "SELECT studentid, forename, surname, coursecode, stage, email FROM srs_student WHERE stage = '$stage' ORDER BY stage";

$queryResult = $dbConn->query($sql);

if(empty($stage)) {
    $empty = "SELECT studentid, forename, surname, coursecode, stage, email FROM srs_student ORDER By stage";
    $query2 = $dbConn->query($empty);
    while ($rowObj = $query2->fetch_object()) {
        echo "<div>
				{$rowObj->studentid}, {$rowObj->forename}, {$rowObj->surname},
				{$rowObj->coursecode}, {$rowObj->stage} , {$rowObj->email}
		</div>\n";
    }
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
