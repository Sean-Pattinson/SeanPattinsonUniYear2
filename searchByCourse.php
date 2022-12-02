<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Student Course</title>
</head>
<body>
<h1>Students</h1>
<?php
include 'database_conn.php';      // make db connection

$course = isset($_REQUEST['course']) ? $_REQUEST['course'] : null;
$sql = "SELECT studentid, forename, surname, coursecode, stage, email FROM srs_student WHERE coursecode = '$course'";

$queryResult = $dbConn->query($sql);

if(empty($course)) {
    $empty = "SELECT studentid, forename, surname, coursecode, stage, email FROM srs_student";
    $query2 = $dbConn->query($empty);
    while($rowObj = $query2->fetch_object()) {
        echo "<div>
				{$rowObj->studentid}, {$rowObj->forename}, {$rowObj->surname},
				{$rowObj->coursecode}, {$rowObj->stage} , {$rowObj->email}
		</div>\n";
    }
}
else if(isset($course)) {
    while($rowObj = $queryResult->fetch_object()) {
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
