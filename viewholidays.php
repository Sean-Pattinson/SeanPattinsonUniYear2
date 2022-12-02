<!DOCTYPE html>
<html lang="en">
<head>
    <link href="premierchoiceholidays.css" rel="stylesheet" type="text/css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holidays</title>
</head>
<body>
    <a href="index.html"><!-- link banner back to homepage -->
        <img id="banner" src="pcholidaysbanner.png" alt="Premier Choice Holidays Banner."/> <!-- premier choice holidays banner. -->
    </a>
    <br/>
    <nav> <!-- This is the nav section that I will use to house my navbar. -->
        <ul class="topnav"> <!-- ul with class that will use css to style into navbar -->
            <li><a href="index.html">Home</a></li>
            <li><a class="active" href="viewholidays.php">View Holidays</a></li>
            <li><a href="admin.php">Admin</a></li>
            <li><a href="credits.html">Credits</a></li>
            <li><a href="wireframe.pdf">Wireframe</a></li>
    </ul>
</nav>
    <div>
    <div class="holidays">
        <span class="title">Title</span>
        <span class="category">Type of Holiday</span>
        <span class="description">Description</span>
        <span class="destination">Destination</span>
        <span class="duration">Duration</span>
        <span class="price">Price</span>
    </div>
<?php
    include 'database_conn.php';	  // make db connection

    //SQL to retrieve information from database to be displayed on page
    $holidaysql = "SELECT holidayTitle, catDesc, holidayDescription, locationName, country, holidayPrice, holidayDuration
    FROM PCH_holidays JOIN PCH_category ON PCH_category.catID = PCH_holidays.catID
    JOIN PCH_location ON PCH_location.locationID = PCH_holidays.locationID
    ORDER BY holidayTitle";

    $queryResult = $dbConn->query($holidaysql);

    // Check for and handle query failure
    if($queryResult === false) {
    echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
    exit;
}
    // Otherwise fetch all the rows returned by the query one by one
    else {
        while($rowObj = $queryResult->fetch_object()){
            echo "<div class='searchResults'>
                    <span class='holidayTitle'>{$rowObj->holidayTitle}</span>
                    <span class='category'>{$rowObj->catDesc}</span>
                    <span class='description'>{$rowObj->holidayDescription}</span>
                    <span class='destination'>{$rowObj->locationName}, {$rowObj->country} </span>
                    <span class='duration'>{$rowObj->holidayDuration} Days</span>
                    <span class='price'>£{$rowObj->holidayPrice}</span>
                  </div> \n";
    }
}
    //Close database Connection
    $queryResult->close();
    $dbConn->close();
?>
    </div>
</body>
</html>