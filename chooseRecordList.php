<?php
session_start();
require_once("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>chooseRecordList</title>
    <link rel="stylesheet" type="text/css" href="Assignment2019.css">
</head>
<body>
<?php
display_nav();
if (isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true) {
    echo "<form id='logout' method='post' action='logout.php'>
            <input type='submit' value='Logout' />
            </form>";
        try {

            $dbConn = getConnection();

            $fetchRecordsSQL = "SELECT recordTitle, recordYear, pubName, catDesc, recordPrice, recordID, location
		FROM nmc_records
		INNER JOIN nmc_category
		ON nmc_category.catID = nmc_records.catID
		INNER JOIN nmc_publisher
		ON nmc_publisher.pubID = nmc_records.pubID
		ORDER BY recordTitle";
            $stmtFetch = $dbConn->prepare($fetchRecordsSQL);
            $stmtFetch->execute();


            while ($rowObj = $stmtFetch->fetchObject()) {
                echo "<div class='Record'>\n
	<span class='recordTitle'>
	<a href='editRecordForm.php?recordID={$rowObj->recordID}' method='get'>{$rowObj->recordTitle}</a><br/></span>\n
	<span class='recordYear'>Year: {$rowObj->recordYear}</span>\n
	<span class='catDesc'>Category: {$rowObj->catDesc}</span>\n
	<span class='recordPrice'>Price: £{$rowObj->recordPrice}</span>\n
	</div>\n";
            }
        } catch (Exception $e) {
            echo "<p>Query failed: " . $e->getMessage() . "</p>\n";
        }
    } else {
    echo "<div class='logon'>
        <form method='post' action='loginProcess.php'>
            Username <input type='text' name='username' />
            Password <input type='password' name='password' />
            <input type='submit' value='Logon' />
        </form>
    </div>";
    echo "Error you must be logged in to view this page, please log in.";
    }
    session_write_close();
?>