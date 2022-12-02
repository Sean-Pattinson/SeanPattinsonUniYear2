<!DOCTYPE html>
<html lang="en">
<head>
    <link href="premierchoiceholidays.css" rel="stylesheet" type="text/css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<a href="index.html"><!-- link banner back to homepage -->
    <img id="banner" src="pcholidaysbanner.png" alt="Premier Choice Holidays Banner."/> <!-- premier choice holidays banner. -->
</a>
<br/>
<nav> <!-- This is the nav section that I will use to house my navbar. -->
    <ul class="topnav"> <!-- ul with class that will use css to style into navbar -->
        <li><a href="index.html">Home</a></li>
        <li><a href="viewholidays.php">View Holidays</a></li>
        <li><a class="active" href="admin.php">Admin</a></li>
        <li><a href="credits.html">Credits</a></li>
        <li><a href="wireframe.pdf">Wireframe</a></li>
    </ul>
</nav>
<div>
<form id="addHoliday" action="addHoliday.php" method="get">
    <div>Holiday Title: <input type="text" name="holidayTitle" required/></div>
    <div>Description: <input type="text" name="holidayDescription"/></div>
    <div>Duration: <input type="number" name="holidayDuration" required/></div>
    <div>Price: <input type="text" name="holidayPrice" required/></div>
    <div>
        Holiday Category:
        <select name="catID" required>
            <option value="">Select Category.</option>
            <?php
            include 'database_conn.php';  // make db connection

            //gets category description and populates dropdown
            $catdescsql = "SELECT catID, catDesc
            FROM PCH_category";

            $queryResult = $dbConn->query($catdescsql);

            // Check for and handle query failure
            if($queryResult === false) {
                echo "<p>Query failed: " . $dbConn->error . "</p>\n</body>\n</html>";
                exit;
            }
            //otherwise return the requested data as options
            else {
                while ($rowObj = $queryResult->fetch_object()) {
                    echo "<option value={$rowObj->catID}>{$rowObj->catDesc}</option>";
                }
            }
            ?>
        </select>
    </div>
    <div>
        Location of holiday:
        <select name="locationID" required>
            <option value="">Select Location.</option>
            <?php
            include 'database_conn.php';  // make db connection

            $locationsql = "SELECT locationID, locationName, country
            FROM PCH_location";

            $queryResult = $dbConn->query($locationsql);

            // Check for and handle query failure
        if($queryResult === false) {
            echo "<p>Query failed: " . $dbConn->error . "</p>\n</body>\n</html>";
        exit;
    }
            //otherwise return the requested data as options
        else {
                while ($rowObj = $queryResult->fetch_object()) {
                    echo "<option value={$rowObj->locationID}>{$rowObj->locationName}, {$rowObj->country}</option>";
                }
            }

            //Close database Connection
            $queryResult->close();
            $dbConn->close();
            ?>
        </select>
    </div>
    <div><input type="submit" value="Submit"/></div>
</form>
</div>
</body>
</html>