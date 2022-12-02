<?php
try {
    require_once('functions.php');
    $dbConn = getConnection();

    $sqlUpdateStores = "INSERT INTO Stores(storeid, storesname, franchisee)
    values (1, Peterlee, 1)";

    $stmtUpdate = $dbConn->prepare($sqlUpdateStores);
    $success = $stmtUpdate->execute();

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
