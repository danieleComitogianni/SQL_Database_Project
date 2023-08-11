<?php 

require_once '../database.php';

if(isset($_GET["studentID"])) {

    $studentID = $_GET["studentID"];

    $statement = $conn->prepare('SELECT * FROM zcc353_1.studentRecords WHERE studentID = :studentID');
    $statement->bindParam(":studentID", $studentID);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!$records) {
        echo "No records found for this studentID.";
        exit;
    }

} else {
    echo "studentID not provided in the URL.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record</title>
</head>
<body>
    <h1>Student's Records</h1>
    <table>
        <thead>
            <tr>
                <td>startDate</td>
                <td>endDate</td>
                <td>facilityName</td>
                <td>studentID</td>
                <td>level</td>
                <td>studentRecordID</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record) { ?>
                <tr>
                    <td><?= $record["startDate"] ?></td>
                    <td><?= $record["endDate"] ?></td>
                    <td><?= $record["facilityName"] ?></td>
                    <td><?= $record["studentID"] ?></td>
                    <td><?= $record["level"] ?></td>
                    <td><?= $record["studentRecordID"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="./">Back to Students</a>
</body>
</html>
