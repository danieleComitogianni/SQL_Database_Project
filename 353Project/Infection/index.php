<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM zcc353_1.infections AS infections');
$statement->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Infection Records</h1>
    <a href="./create.php">Add New Infection Record</a>
    <table>
        <thead>
            <tr>
                <td>Infection ID</td>
                <td>Med ID</td>
                <td>Type Of Infection</td>
                <td>Date Of Infection</td>
                
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["infecID"] ?></td>
                    <td><?= $row["medID"] ?></td>
                    <td><?= $row["typeOfInfection"] ?></td>
                    <td><?= $row["dateOfInfection"] ?></td>
                    <td>
                        <a href="./delete.php?infecID=<?= $row["infecID"] ?>">Delete</a>
                        <a href="./edit.php?infecID=<?= $row["infecID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Home Page</a>