<?php 
require_once '../database.php';

// Check if medID is set in URL
if(!isset($_GET["medID"])) {
    die("medID not provided in the URL.");
}

$medID = $_GET["medID"];

// Prepare and execute the query to fetch details
$statement = $conn->prepare("SELECT * FROM zcc353_1.person WHERE medID = :medID");
$statement->bindParam(":medID", $medID, PDO::PARAM_INT);
$statement->execute();

$person = $statement->fetch(PDO::FETCH_ASSOC);

if(!$person){
    die('No record found for specified medID');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details for <?= $person["fName"] ?> <?= $person["lName"] ?></title>
</head>
<body>
    <h1>Details for <?= $person["fName"] ?> <?= $person["lName"] ?></h1>
    
    <p>Medical ID: <?= $person["medID"] ?></p>
    <p>First Name: <?= $person["fName"] ?></p>
    <p>Last Name: <?= $person["lName"] ?></p>
    <p>Date Of Birth: <?= $person["dateOfBirth"] ?></p>
    <p>Phone Number: <?= $person["phoneNumber"] ?></p>
    <p>Address: <?= $person["address"] ?></p>
    <p>Postal Code: <?= $person["postalCode"] ?></p>
    <p>Citizenship: <?= $person["citizenship"] ?></p>
    <p>Email: <?= $person["email"] ?></p>
    <p>Medical Card Expiration Date: <?= $person["medExp"] ?></p>
    
    <a href="./">Back to List</a>
</body>
</html>
