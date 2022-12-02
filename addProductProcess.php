<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>addProductProcess</title>
</head>
<body>
<?php
list($input, $errors) = validate_form();
if ($errors) {
    echo show_errors($errors);
}
else {
    echo process_form($input);
}

function show_errors($errors)
{
    $output = '';
    foreach ($errors as $error)
    {
        $output .= $error;
    }
    $output . 'Please try using the add products form<a href="addProductForm.html">again</a>';
}

function validate_form()
{
    $input = array();
    $errors = array();


    $input['productName'] = filter_has_var(INPUT_GET, 'productName') ? $_GET['productName'] : null;
    $input['description'] = filter_has_var(INPUT_GET, 'description') ? $_GET['description'] : null;
    $input['categoryID'] = filter_has_var(INPUT_GET, 'categoryID') ? $_GET['categoryID'] : null;
    $input['price'] = filter_has_var(INPUT_GET, 'price') ? $_GET['price'] : null;

    $input['productName'] = trim($input['productName']);
    $input['description'] = trim($input['description']);
    $input['categoryID'] = trim($input['categoryID']);
    $input['price'] = trim($input['price']);

    if (strlen($input['productName'] > 50)) {
        $errors[] = "Error: Product name entered too long";
    } elseif (strlen($input['description'] > 300)) {
        $errors[] = "Error: Description entered is too long";
    } elseif (strlen($input['categoryID'] > 3)) {
        $errors[] = "Error: Category ID entered is too long";
    } elseif (strlen($input['price'] > 6)) {
        $errors[] = "Error: Price entered is too large";
    } elseif (!filter_var($input['price'], FILTER_VALIDATE_INT)) {
        $errors[] = "Error: Price should be a number";
    } elseif (!in_array($input['categoryID'])) {
        $errors[] = "Error: Category ID invalid";
    }
    if (!empty($errors)) {
        $error = show_errors($errors);
        echo $error;

    }
    return array ($input, $errors);
}
function process_form($input)
{
        require_once("functions.php");
        $productName = ($input['productName']);
        $description = ($input['description']);
        $price = ($input['price']);
        $categoryID = ($input['categoryID']);
        $dBConn = getConnection();
        $sqlInsert = "INSERT INTO p_products (productName, description, categoryID, price)
                      VALUES (:productName, :description, :categoryID, :price)";
        $stmt = $dBConn->prepare($sqlInsert);
        $stmt->execute(array(':productName' => $productName, ':description' => $description, ':categoryID' => $categoryID, ':price' => $price));

        echo "<h1>Product details</h1>\n";
        echo "<p>Name: $productName</p>\n";
        echo "<p>Description: $description</p>\n";
        echo "<p>Category: $categoryID</p>\n";
        echo "<p>Price: $price</p>\n";
}

validate_form();
process_form($input);
?>
</body>
</html>