<!DOCTYPE html>
<html lang="en">
<head>
    <link href="film.css" rel="stylesheet" type="text/css" /> <!--link the style sheet to page -->
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Homepage</title>
</head>
<body>
<?php
include 'database_conn.php';	  // make db connection

$sql = "SELECT filmID, title, categoryName, notes
        FROM film
  	    INNER JOIN film_category
	    ON film_category.categoryID = film.categoryID
        ORDER BY title";

$queryResult = $dbConn->query($sql);

// Check for and handle query failure
if($queryResult === false) {
    echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
    exit;
}
// Otherwise fetch all the rows returned by the query one by one
else {
    while($rowObj = $queryResult->fetch_object()){
        echo "<div class='film'>
                <span class='filmID'>{$rowObj->filmID}</span> 
                <span class='title'>{$rowObj->title}</span> 
                <span class='category'>{$rowObj->categoryName}</span> 
                <span class='notes'>{$rowObj->notes}</span>
              </div> \n";
    }
}
$queryResult->close();
$dbConn->close();
?>
</body>
</html>