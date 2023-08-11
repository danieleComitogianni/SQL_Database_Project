<?php 

require_once '../database.php';

if(isset($_GET["medID"])) {

    $medID = $_GET["medID"];

    $statement = $conn->prepare('SELECT * FROM zcc353_1.person WHERE medID = :medID');
    $statement->bindParam(":medID", $medID);
    $statement->execute();
    $person = $statement->fetch(PDO::FETCH_ASSOC);

    $studentStatement = $conn->prepare('SELECT studentID FROM zcc353_1.student WHERE medID = :medID');
    $studentStatement->bindParam(":medID", $medID);
    $studentStatement->execute();
    $student = $studentStatement->fetch(PDO::FETCH_ASSOC);

    if (!$person) {
        echo "No person found with this medID.";
        exit;
    }

    if (!$student) {
        echo "No student found with this medID.";
        exit;
    }

} else {
    echo "medID not provided in the URL.";
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Person</title>
</head>
<body>
    <h1>Person Information</h1>
    <a href="./studentRecord.php?studentID=<?= $student["studentID"] ?>">Student Record</a>
    <table>
        <tr>
            <td>Med ID:</td>
            <td><?= $person["medID"] ?></td>
        </tr>
        <tr>
            <td>First Name:</td>
            <td><?= $person["fName"] ?></td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td><?= $person["lName"] ?></td>
        </tr>
    </table>
    <a href="./">Back to Students</a>
</body>
</html>
