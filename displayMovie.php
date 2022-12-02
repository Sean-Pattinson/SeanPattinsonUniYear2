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

    IF (!empty($movieID)) {
        $sqlQuery = "SELECT title, categoryName, directorName, notes, movieID
		FROM nc_movie
		INNER JOIN nc_category
		ON nc_category.categoryID = nc_movie.categoryID
		INNER JOIN nc_director
		ON nc_director.directorID = nc_movie.directorID
	    WHERE movieID=$movieID";

        $queryResult = $dbConn->query($sqlQuery);

        $rowObj = $queryResult->fetchObject();

        echo "<div class='movie'>\n
        <br>
	<span class='title'>{$rowObj->title}</span>\n
	<br>
	<span class='categoryName'>{$rowObj->categoryName}</span>\n
	<br>
	<span class='directorName'>{$rowObj->directorName}</span>\n
	<br>
	<span class='notes'>{$rowObj->notes}</span>
	
	<span><p>Choose another <a href='chooseMovieList.php'>Movie</a>.</p></span>\n
	</div>\n";

    } else {
        echo "<p>Please choose a movie from the previous page</p>";
    }
}
catch (Exception $e){
    echo "<p>Query failed: ".$e->getMessage()."</p>\n";
}
?>