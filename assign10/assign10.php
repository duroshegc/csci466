<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSCI 466 Assignment 10</title>
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

echo "<h2>1. Suppliers and Details: </h2>";
$sql = 'SELECT * FROM S;';
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

// Step 2
echo "<h2>2. Parts and Details: </h2>"; 
$sql = 'SELECT * FROM P;';
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

<form method="POST" action="partsupplier.php">
<h2>3. Parts information</h2>
    <label for="part">Select a Part:</label>
    <select name="part" id="part">
        <?php
            $sql_parts = 'SELECT * FROM P;';
            $statement = $pdo->query($sql_parts);
            $statement->execute();
            $sql_parts = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($sql_parts as $part)
            {
                echo "<option value={$part['P']}>{$part['P']}</option>";
            }
        ?> 
    </select>
    <input type="submit" name="Submit"><br><br>

</form>

<form method="POST" action="supplyqty.php">
    <h2>4. Supplier Information on Parts</h2> 
    <label for="supplier">Select a Supplier:</label>
    <select name="supplier" id="supplier">
        <?php
            $sql_supplier = 'SELECT * FROM S;';
            $statement = $pdo->query($sql_supplier);
            $statement->execute();
            $sql_supplier = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($sql_supplier as $supplier)
            {
                echo "<option value={$supplier['S']}>{$supplier['S']}</option>";
            }
        ?> 
    </select>
    <input type="submit" name="Submit"><br>

</form>

<form method="POST" action="purchase.php">
    <h2>5. Transaction</h2> 
    <label for="quantity">Select Supplier, Part and Quantity:</label>
    <select name="supplier" id="supplier">
        <?php
            $sql_supplier = 'SELECT * FROM S;';
            $statement = $pdo->query($sql_supplier);
            $statement->execute();
            $sql_supplier = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($sql_supplier as $supplier)
            {
                echo "<option value={$supplier['S']}>{$supplier['S']}</option>";
            }
        ?> 
    </select>

    <select name="part" id="part">
        <?php
            $sql_parts = 'SELECT * FROM P;';
            $statement = $pdo->query($sql_parts);
            $statement->execute();
            $sql_parts = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($sql_parts as $part)
            {
                echo "<option value={$part['P']}>{$part['P']}</option>";
            }
        ?> 
    </select>
    <label for="quantity">QTY</label>
    <input type="number" id="quantity" name="quantity" min="0" max="1000">
    <input type="submit" name="Submit"><br>
</form>

<form method="POST" action="addedpart.php"> 
<?php
    $sql_add = 'SELECT * FROM P;';
    $statement = $pdo->query($sql_add);
    $statement->execute();
    $sql_add = $statement->fetchAll(PDO::FETCH_ASSOC);

?> 
    <h2>6. Add a new a Part:</h2>  

    <label for="name">Part Name:</label>
    <input type="text" id="pname" name="pname"><br>
    <label for="color">Part Color:</label>
    <input type="text" id="color" name="color"><br>
    <label for="weight">Part Weight:</label>
    <input type="number" id="pweight" name="pweight" min="0" max="1000"><br>
    <input type="submit" value="Add Part">

</form>


<form method="POST" action="insert_supplier_part.php">
    <h2>7. Add Supplier-Part Relation</h2> 
    <label for="supplier">Select a Supplier:</label> <br>
    <select name="supplier" id="supplier">
        <?php
            $sql_supplier = 'SELECT * FROM S;';
            $statement = $pdo->query($sql_supplier);
            $statement->execute();
            $sql_supplier = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($sql_supplier as $supplier)
            {
                echo "<option value={$supplier['S']}>{$supplier['S']}</option>";
            }
        ?> 
        
    </select><br>

    <label for="part">Select a Part:</label><br>
    <select name="part" id="part">
        <?php
            $sql_parts = 'SELECT * FROM P;';
            $statement = $pdo->query($sql_parts);
            $statement->execute();
            $sql_parts = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($sql_parts as $part)
            {
                echo "<option value={$part['P']}>{$part['P']}</option>";
            }
        ?> 
    </select><br><br>

    <label for="quantity">QTY</label>
    <input type="number" id="quantity" name="quantity" min="0" max="1000">

    <input type="submit" name="Submit"><br>
</form>



</body>
</html>