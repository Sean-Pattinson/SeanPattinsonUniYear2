<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Fish Order</title>
</head>
<body>
<h1>You Ordered</h1>
<?php
$fish = $_GET['fish'];
$quantity = $_GET['quantity'];
$Name = $_GET['Name'];
$Address = $_GET['Address'];
echo "<p>Nome of customer: $Name</p>";
"<br/>";
echo "<p>Adress: $Address</p>";
"<br/>";
echo "<p>Your choice of fish was $fish</p>";
"<br/>";
echo "<p>You ordered $quantity</p>";
?>
</body>
</html>