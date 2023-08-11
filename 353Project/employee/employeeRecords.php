<?php 
require_once '../database.php';

if(!isset($_GET["empID"])) {
    die("empID not provided in the URL.");
}

$empID = $_GET["empID"];

$statement = $conn->prepare("SELECT * FROM zcc353_1.employeeRecords WHERE empID = :empID");
$statement->bindParam(":empID", $empID, PDO::PARAM_INT);
$statement->execute();

$records = $statement->fetchAll(PDO::FETCH_ASSOC);

if(!$records){
    die('No records found for specified empID');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Records for Employee ID <?= $empID ?></title>
</head>
<body>
    <h1>Employee Records for Employee ID <?= $empID ?></h1>
    
    <table>
        <thead>
            <tr>
                <td>Role Type</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Employee Record ID</td>
                <td>Facility ID</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record) { ?>
                <tr>
                    <td><?= $record["roleType"] ?></td>
                    <td><?= $record["startDate"] ?></td>
                    <td><?= $record["endDate"] ?></td>
                    <td><?= $record["empRecordID"] ?></td>
                    <td><?= $record["facilityID"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="./display.php?medID=<?= $data["medID"] ?>">Back to Employee Details</a>
</body>
</html>
