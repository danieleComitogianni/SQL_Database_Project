<?php 
require_once '../database.php';

if(!isset($_GET["medID"])) {
    die("medID not provided in the URL.");
}

$medID = $_GET["medID"];

$statement = $conn->prepare("SELECT * FROM zcc353_1.employee AS e JOIN zcc353_1.person AS p ON e.medID = p.medID WHERE e.medID = :medID");
$statement->bindParam(":medID", $medID, PDO::PARAM_INT);
$statement->execute();

$data = $statement->fetch(PDO::FETCH_ASSOC);

if(!$data){
    die('No record found for specified medID');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details for Employee with Med ID <?= $data["medID"] ?></title>
</head>
<body>
    <h1>Details for Employee with Med ID <?= $data["medID"] ?></h1>
    
    <h2>Employee Details:</h2>
    <p>Med ID: <?= $data["medID"] ?></p>
    <p>Employee ID: <?= $data["empID"] ?></p>
    <a href="./employeeRecords.php?empID=<?= $data["empID"] ?>">Employee Records</a></p>
    <p>Med ID: <?= $data["medID"] ?></p>

    <h2>Person Details:</h2>
    <p>First Name: <?= $data["fName"] ?></p>
    <p>Last Name: <?= $data["lName"] ?></p>
    <p>Date Of Birth: <?= $data["dateOfBirth"] ?></p>
    <p>Phone Number: <?= $data["phoneNumber"] ?></p>
    

    <a href="./">Back to List</a>
</body>
</html>

