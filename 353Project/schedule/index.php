<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM zcc353_1.schedule AS schedule');
$statement->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
</head>
<body>
    <h1>List of Schedule</h1>
    <a href="./create.php">Add New Schedule</a><br>
    <a href="./search.php">Search Schedule</a>

    <table>
        <thead>
            <tr>
                <td>date</td>
                <td>startTime</td>
                <td>endTime</td>
                <td>scheduleID</td>
                <td>empID</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["date"] ?></td>
                    <td><?= $row["startTime"] ?></td>
                    <td><?= $row["endTime"] ?></td>
                    <td><?= $row["scheduleID"] ?></td>
                    <td><?= $row["empID"] ?></td>
                  
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Home Page</a>
</body>
</html>