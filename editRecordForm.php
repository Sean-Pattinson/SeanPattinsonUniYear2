<?php
session_start();
require_once("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record Form</title>
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

            $recordID = filter_has_var(INPUT_GET,'recordID') ? $_GET['recordID'] : null;
            $recordID = trim($recordID);
            $recordID = filter_var($recordID, FILTER_SANITIZE_STRING);
            $recordID = filter_var($recordID, FILTER_SANITIZE_SPECIAL_CHARS);

            IF (!empty($recordID)) {
                $recordDetails = "SELECT recordTitle, nmc_records.catID, nmc_records.pubID, recordID, pubName, recordPrice, recordYear
		                          FROM nmc_records
		                          INNER JOIN nmc_category
		                          ON nmc_category.catID = nmc_records.catID
		                          INNER JOIN nmc_publisher
		                          ON nmc_publisher.pubID = nmc_records.pubID
	                              WHERE recordID= :recordID";

                $sqlPub = "SELECT pubID, pubName
        FROM nmc_publisher";

                $sqlCat = "SELECT catID, catDesc
        FROM nmc_category";

                $stmtRecord = $dbConn->prepare($recordDetails);
                $stmtRecord->execute(array(':recordID' => $recordID));
                $recordDetails = $stmtRecord->fetchObject();
                $stmtPublisher = $dbConn->query($sqlPub);
                $stmtCategory = $dbConn->query($sqlCat);

                echo "<h2>Update '{$recordDetails->recordTitle}'</h2>";
                echo "<form id='update' action='updateRecord.php' method='POST'>
  Record ID:
  <input type='text' name='recordID' value='{$recordDetails->recordID}' readonly/>
  <br/>
  <br/>
  Title:
  <input type='text' name='title' value='{$recordDetails->recordTitle}'/>
  <br/>
  <br/>
  Year:
  <input type='text' name='Year' value='{$recordDetails->recordYear}'/>
  <br/>
  <br/>
  Category:
  <select name='category'>";

                while ($categories = $stmtCategory->fetchObject()) {
                    $selected = ($recordDetails->catID == $categories->catID) ? 'selected' : '';

                    echo "<option value='{$categories->catID}' $selected >{$categories->catDesc}</option>\n";
                }

                echo "\t</select>";

                echo "<br>
  <br>
  Publisher:
  <select name='publisher'>\n";

                while ($publishers = $stmtPublisher->fetchObject()) {
                    $selected = ($recordDetails->pubID == $publishers->pubID) ? 'selected' : '';

                    echo "<option value='{$publishers->pubID}' $selected >{$publishers->pubName}</option>\n";
                }

                echo "\t</select>";
                echo "<br/>
  <br/>
  Price:
  <input type='text' name='price' value='{$recordDetails->recordPrice}'/>
  <br/>
  <br/>
  <input type='submit' value='Update Record'/> 
</form> 
	
	<span><p>Choose another <a href='chooseRecordList.php'>Record</a>.</p></span>\n
	</div>\n";

            } else {
                echo "<a href='chooseRecordList.php'>Please choose a record to edit from the previous page</a>";
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
</body>
</html>
