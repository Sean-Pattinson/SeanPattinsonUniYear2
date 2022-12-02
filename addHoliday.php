<!DOCTYPE html>
<html lang="en">
<head>
    <link href="premierchoiceholidays.css" rel="stylesheet" type="text/css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <title>Confirmation Page</title>
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
    <h1>Holiday Details</h1>
    <div class="holidays">
        <span class="title">Title</span>
        <span class="category">Category ID</span>
        <span class="description">Description</span>
        <span class="destination">Location ID</span>
        <span class="duration">Duration</span>
        <span class="price">Price</span>
    </div>
    <?php
    include 'database_conn.php'; //make db connection

    //cheack that variables have been set if not set them as null
$holidayTitle = isset($_REQUEST['holidayTitle']) ? $_REQUEST['holidayTitle'] : null;
$holidayDescription = isset($_REQUEST['holidayDescription']) ? $_REQUEST['holidayDescription'] : null;
$holidayDuration = isset($_REQUEST['holidayDuration']) ? $_REQUEST['holidayDuration'] : null;
$holidayPrice = isset($_REQUEST['holidayPrice']) ? $_REQUEST['holidayPrice'] : null;
$catID = isset($_REQUEST['catID']) ? $_REQUEST['catID'] : null;
$locationID = isset($_REQUEST['locationID']) ? $_REQUEST['locationID'] : null;

//SQL to add the data provided by admin to the database
$inputsql = "INSERT into PCH_holidays
                    (holidayTitle, holidayDescription, holidayDuration, locationID, catID, holidayPrice)
              values ('$holidayTitle',
                      '$holidayDescription',
                      '$holidayDuration',
                      '$locationID',
                      '$catID',
                      '$holidayPrice')";

//variable to hold the query
$success = $dbConn->query($inputsql);

//Check for and handle query failure.
if ($success === false) {
    echo "<p>Error adding holiday to database, ";
    echo "<a href='admin.php'>Try again</a>a></p>\n";
}

// otherwise show the holiday details for the holiday added.
else {
        echo "<div class='searchResults'>";
        echo "<span class='holidayTitle'>{$holidayTitle}</span>";

    //check for category ID and display correct category depending on ID.
    if ($catID == 'c1') {
            echo "<span class='category'>Luxury</span>";
    } elseif ($catID == 'c2') {
            echo "<span class='category'>Tour</span>";
    } elseif ($catID == 'c3') {
            echo "<span class='category'>Safari</span>";
    } elseif ($catID == 'c4') {
            echo "<span class='category'>Golf</span>";
    } elseif ($catID == 'c5') {
            echo "<span class='category'>Weddings</span>";
    } elseif ($catID == 'c6') {
            echo "<span class='category'>Walking</span>";
    } elseif ($catID == 'c7') {
            echo "<span class='category'>Opera</span>";
    } else { //error handling if an invalid category is somehow entered
        echo "<p>Error you have selected an invalid category";
    }
        echo "<span class='description'>{$holidayDescription}</span>";

    //check for the locationID and display collect location depending on ID.
    if($locationID =='l1') {
        echo "<span class='destination'>Milaidhoo Island, Maldives</span>";
    } elseif ($locationID == 'l2') {
        echo "<span class='destination'>Rangali Island, Maldives</span>";
    } elseif ($locationID == 'l3') {
        echo "<span class='destination'>Zanzibar, Tanzania</span>";
    } elseif ($locationID == 'l4') {
        echo "<span class='destination'>Boston, USA</span>";
    } elseif ($locationID == 'l5') {
        echo "<span class='destination'>San Francisco, USA</span>";
    } elseif ($locationID == 'l6') {
        echo "<span class='destination'>Nairobi, Kenya</span>";
    } elseif ($locationID == 'l7') {
        echo "<span class='destination'>Algarve, Portugal</span>";
    } elseif ($locationID == 'l8') {
        echo "<span class='destination'>New York, USA</span>";
    } elseif ($locationID == 'l9') {
        echo "<span class='destination'>Sorrento, Italy</span>";
    } elseif ($locationID == 'l10') {
        echo "<span class='destination'>Verona, Italy</span>";
    } else { //error handling if an invalid location is somehow entered
        echo "<p>Error you have selected an invalid location";
    }
        echo "<span class='duration'>{$holidayDuration} Days</span>
              <span class='price'>£{$holidayPrice}</span>
          </div> \n";
    }
    echo "<p>Return to the <a href='index.html'>Home Page</a></p>\n";

//display an image depending on the category of holiday added
if($catID == 'c1') {
    echo "<img id='luxuryholiday' src='luxury.jpg' alt='luxury holiday image'/>";
} elseif ($catID == 'c2') {
    echo "<img id='tourholiday' src='tour.jpg' alt='tour holiday image'/>";
} elseif ($catID == 'c3') {
    echo "<img id='safariholiday' src='safari.jpg' alt='safari holiday image'/>";
} elseif ($catID == 'c4') {
    echo "<img id='golfholiday' src='golf.jpg' alt='golf holiday image'/>";
} elseif ($catID == 'c5') {
    echo "<img id='weddingholiday' src='wedding.jpg' alt='wedding holiday image'/>";
} elseif ($catID == 'c6') {
    echo "<img id='walkingholiday' src='walking.jpg' alt='walking holiday image'/>";
} elseif ($catID == 'c7') {
    echo "<img id='operaholiday' src='opera.jpg' alt='opera holiday image'/>";
}

    //Close database Connection
    $success->close();
    $dbConn->close();
    ?>
</div>
</body>
</html>