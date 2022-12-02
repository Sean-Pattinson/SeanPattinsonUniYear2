<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search By Course</title>
</head>
<body>
<form id="SearchByCourse" action="searchByCourse.php" method="get">
    <h1>Search by stage</h1>
    <select name="course">
        <option value="">All courses</option>
        <?php

        include 'database_conn.php';

        $sql = "SELECT coursetitle, coursecode FROM srs_course";
        $result = $dbConn->query($sql);

        while($rowObj = $result->fetch_object()) {
            echo "<option value={$rowObj->coursecode}>{$rowObj->coursetitle}</option>";
        }

        ?>
    </select>
    <input type="submit" value="Search">
</form>

</body>
</html>