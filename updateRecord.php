<?php
/**
 * Created by PhpStorm.
 * User: w16004894
 * Date: 04/10/2018
 * Time: 16:56
 */
try {
    require_once("functions.php");
    $dbConn = getConnection();

    $recordID = filter_has_var(INPUT_POST,'recordID') ? $_POST['recordID'] : null;
    $recordTitle = filter_has_var(INPUT_POST,'title') ? $_POST['title'] : null;
    $category = filter_has_var(INPUT_POST, 'category') ? $_POST['category'] : null;
    $publisher = filter_has_var(INPUT_POST,'publisher') ? $_POST{'publisher'} : null;
    $recordYear= filter_has_var(INPUT_POST, 'Year') ? $_POST['Year'] : null;
    $price = filter_has_var(INPUT_POST, 'price') ?  $_POST['price'] : null;


    $sqlUpdateRecord = "UPDATE nmc_records
    SET recordTitle=:recordTitle, catID=:category, pubID=:publisher, recordPrice=:price, recordYear=:recordYear
    WHERE recordID=:recordID";

    $stmtUpdate = $dbConn->prepare($sqlUpdateRecord);
    $success = $stmtUpdate->execute(array('recordID' => $recordID, 'recordTitle' => $recordTitle, 'category' => $category, 'publisher' => $publisher, 'price' => $price, 'recordYear' => $recordYear));

    IF ($success === false) {
        echo "<div>Failed to update the record.</div>";
    }

    ELSE {
        echo "<div>Record details have been updated successfully
<br>
<br>
Return to the <a href='chooseRecordList.php'>movie list</a></div>";

    }

}

catch (Exception $e){
    echo "<p>Query failed: ".$e->getMessage()."</p>\n
<pre></pre>";
}
?>