<?php
require_once("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="Assignment2019.css">
</head>
<body>
<?php
display_nav();

if (isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true) {
echo "<form id='logout' method='post' action='logout.php'>
    <input type='submit' value='Logout' />
</form>"; } else {
    echo "<div class='logon'>
        <form method='post' action='loginProcess.php'>
            Username <input type='text' name='username' />
            Password <input type='password' name='password' />
            <input type='submit' value='Logon' />
        </form>
    </div>"; };
?>

<aside id="offers">
    <p>

    </p>
</aside>
<aside id="XMLOffers">
    <p>

    </p>
</aside>
<script type="text/javascript">
    const requestOffer = 'getOffers.php';
    const requestXML = 'getOffers.php?useXML';

    //load offer to be displayed on page load.
    window.addEventListener('load',function () {
        'use strict';
        const offers = document.getElementById('offers');
        offers.addEventListener('load', setTimeout(function () {
            getRequest(requestOffer, updateOffers)
        }, 0));
        clearTimeout();
    });

    //Update Offers section every 5 seconds.
    window.addEventListener('load',function () {
        'use strict';
        //clearTimeout();
        const offers = document.getElementById('offers');
        offers.addEventListener('load', setInterval(function () {
            getRequest(requestOffer, updateOffers)
        }, 5000));
    });

    //Load XMLOffer to be displayed on page load.
    window.addEventListener('load',function () {
        'use strict';
        const XMLOffers = document.getElementById('XMLOffers');
        XMLOffers.addEventListener('load', setTimeout(function () {
            getRequest(requestXML, updateXMLOffers)}, 0));
        clearTimeout();
    });

    //update XMLOffers every 5 seconds.
    window.addEventListener('load',function () {
        'use strict';
        const XMLOffers = document.getElementById('XMLOffers');
        XMLOffers.addEventListener('load', setInterval(function () {
            getRequest(requestXML, updateXMLOffers)}, 5000));
    });

    //function to get the requested offer
    function getRequest( url, callback ) {
        'use strict';

        const httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function() {
            let completed = 4, successful = 200;
            if (httpRequest.readyState == completed) {
                if (httpRequest.status == successful) {
                    callback(httpRequest.responseText);
                }
                else {
                    alert('There was a problem with the request.');
                }
            }
        };



        httpRequest.open('get', url, true);
        httpRequest.send(null);
    }

    //update the offer section
    function updateOffers( offer ) {
        'use strict';
        offers.innerHTML = "<h2>Offers</h2>" + "<p>" + offer + "</p>";
    }

    //update the xml offers section
    function updateXMLOffers(XMLOffer) {
        'use strict';
        const parser = new DOMParser();
        const xmlDoc = parser.parseFromString(XMLOffer, "text/xml");

        const recordTitle = xmlDoc.getElementsByTagName("recordTitle")[0].innerHTML;
        const cat = xmlDoc.getElementsByTagName("catDesc")[0].innerHTML;
        const price = xmlDoc.getElementsByTagName("recordPrice")[0].innerHTML;

        XMLOffers.innerHTML = "<h2>XML Offers</h2>" + "<p>" + recordTitle +" <br/> Category: " + cat + "<br/>Price: " + price + "</p>";
    }
</script>
</body>
</html>