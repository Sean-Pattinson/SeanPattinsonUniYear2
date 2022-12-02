<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Task 5 php script</title>
</head>
<body>
<p>
    <?php
//this is the php for task 5 parts 1 and 2
    $number = 1;
    $limit = 12;

/*
 * this code makes sure that the number is incrementing at
 * the end of the while loop
 */
    while ($number <= 11) {
        $result = $number * $limit;
        echo "$number times 12 = $result<br />\n";
        $number++;

        if ($number == 12) {
            $result = $number * $limit;
            echo "<b>$number times 12 = $result</b><br />\n";

        }

    }
    echo "\n<b> Table Finished</b>";
    ?>
</p>
</body>
</html>
