<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quantity Update</title>
</head>
<body>
<?php

// Database config
$host = 'courses';
$dbname = 'z1978798';
$username = 'z1978798'; // your zID
$password = '2002Sep17'; // your birthday

// Try to connect, or print and quit
$dsn = "mysql:host=$host;dbname=$dbname";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
   die("        <p>Connection to database failed: {$e->getMessage()}</p>\n");
}

$part = $_POST['part'];
$supplier = $_POST['supplier'];
$quantity = $_POST['quantity'];

$sql = "UPDATE SP SET QTY = QTY - :quantity WHERE P = :part AND S = :supplier;";
try {
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $statement->bindParam(':part', $part, PDO::PARAM_STR);
    $statement->bindParam(':supplier', $supplier, PDO::PARAM_STR);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    die("        <p>Query failed: {$e->getMessage()}</p>\n");
}


$sql = "SELECT * FROM SP;";
try {
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("        <p>Query failed: {$e->getMessage()}</p>\n");
}

echo "        <table border=1>\n";
echo "            <tr>\n";
foreach(array_keys($rows[0]) as $heading){
    echo "                <td><strong>$heading<strong></td>\n";
}
echo "            </tr>\n";
foreach($rows as $row){
    echo "            <tr>\n";
    foreach($row as $col) {
        echo "                <td>$col</td>\n";
    }
    echo "            </tr>\n";
}
echo "            </tr>\n";
echo "        </table>\n";

echo "<br>";


?>
</body>
</html>