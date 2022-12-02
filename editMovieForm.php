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
        $movieDetails = "SELECT title, nc_movie.categoryID, nc_movie.directorID, notes, movieID, directorName
		FROM nc_movie
		INNER JOIN nc_category
		ON nc_category.categoryID = nc_movie.categoryID
		INNER JOIN nc_director
		ON nc_director.directorID = nc_movie.directorID
	    WHERE movieID=$movieID";

        $sqlDirector = "SELECT directorID, directorName
        FROM nc_director" ;

        $sqlCategory = "SELECT categoryID, categoryName
        FROM nc_category";

        $movie = $dbConn->query($movieDetails);
        $stmtDirector = $dbConn->query($sqlDirector);
        $stmtCategory = $dbConn->query($sqlCategory);

        $rowObj = $movie->fetchObject();
        echo "<h2>Update '{$rowObj->title}'</h2>";
	echo "<form id='update' action='updateMovie.php' method='GET'>
  Movie ID:
  <input type='text' name='movieID' value='{$rowObj->movieID}' readonly><br>
  <br>
  Title:
  <input type='text' name='title' value='{$rowObj->title}'><br>
  <br>
  Category:
  <select name='category'>";

	while ($categories = $stmtCategory->fetchObject()) {
        $selected = ($rowObj->categoryID == $categories->categoryID) ? 'selected' : '';

	    echo "<option value='{$categories->categoryID}' $selected >{$categories->categoryName}</option>\n";
    }

    echo "\t</select>";

	echo "<br>
  <br>
  Director:
  <select name='director'>\n";

	while ($directors = $stmtDirector->fetchObject()) {
        $selected = ($rowObj->directorID == $directors->directorID) ? 'selected' : '';

        echo "<option value='{$directors->directorID}' $selected >{$directors->directorName}</option>\n";
  }

  echo "\t</select>";
echo "<br>
  <br>
  Notes:<br>
  <textarea name='notes' form='update' rows='10' cols='70'>{$rowObj->notes}</textarea>
  <br>
  <br>
  <input type='submit' value='Update Movie'>  
</form> 
	
	<span><p>Choose another <a href='chooseMovieList2.php'>Movie</a>.</p></span>\n
	</div>\n";

    } else {
        echo "<a href='chooseMovieList2.php'>Please choose a movie to edit from the previous page</a>";
    }
}
catch (Exception $e){
    echo "<p>Query failed: ".$e->getMessage()."</p>\n";
}
?>