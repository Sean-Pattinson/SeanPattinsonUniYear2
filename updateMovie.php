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

    $movieID = isset($_REQUEST['movieID']) ? $_REQUEST['movieID'] : null;
    $title = isset($_REQUEST['title']) ? $_REQUEST['title'] : null;
    $category = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;
    $director = isset($_REQUEST{'director'}) ? $_REQUEST{'director'} : null;
    $notes = isset($_REQUEST['notes']) ? $_REQUEST['notes'] : null;
    $note = $dbConn->quote($notes);

    $sqlUpdateMovie = "UPDATE nc_movie
    SET title='$title', categoryID='$category', directorID='$director', notes=$note
    WHERE movieID='$movieID'";

    $success = $dbConn->query($sqlUpdateMovie);

    IF ($success === false) {
        echo "<div>Failed to update the record.</div>";
    }

    ELSE {
        echo "<div>Movie information has been updated successfully
<br>
<br>
Return to the <a href='chooseMovieList2.php'>movie list</a></div>";

    }

}

catch (Exception $e){
    echo "<p>Query failed: ".$e->getMessage()."</p>\n
<pre></pre>";
}
?>