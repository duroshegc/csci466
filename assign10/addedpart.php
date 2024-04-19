<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Part</title>
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

//$p_id = $_POST['p_id'];
$pname = $_POST['pname'];
$color = $_POST['color'];
$pweight = $_POST['pweight'];


$sql_max_p = "SELECT MAX(P) AS max_p FROM P";
$statement_max_p = $pdo->query($sql_max_p);
$max_p_row = $statement_max_p->fetch(PDO::FETCH_ASSOC);
$max_p = $max_p_row['max_p'];

$next_p = 'P' . ((int) substr($max_p, 1) + 1);

$sql = "INSERT INTO P( P,PNAME, COLOR, WEIGHT) VALUES(:p_id, :pname, :color, :pweight);";
try {
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':p_id', $next_p, PDO::PARAM_STR);
    $statement->bindParam(':pname', $pname, PDO::PARAM_STR);
    $statement->bindParam(':color', $color, PDO::PARAM_STR);
    $statement->bindParam(':pweight', $pweight, PDO::PARAM_INT);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo "<p>New part added succesfully.</p>";

} catch (PDOException $e) {
    die("        <p>Query failed: {$e->getMessage()}</p>\n");
}


$sql = "SELECT * FROM P;";
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