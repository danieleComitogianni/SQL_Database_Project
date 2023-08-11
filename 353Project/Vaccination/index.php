<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM zcc353_1.vaccinations AS vaccinations');
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
    <h1>Vaccination Records</h1>
    <a href="./create.php">Add New Vaccine Record</a>
    <table>
        <thead>
            <tr>
                <td>Vaccination ID</td>
                <td>Med ID</td>
                <td>Type Of Vaccination</td>
                <td>Vaccination Date</td>
                <td>Number of Doses</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["vaccID"] ?></td>
                    <td><?= $row["medID"] ?></td>
                    <td><?= $row["typeOfVaccination"] ?></td>
                    <td><?= $row["vaccinationDate"] ?></td>
                    <td><?= $row["numberOfDoses"] ?></td>
                    <td>
                        <a href="./delete.php?vaccID=<?= $row["vaccID"] ?>">Delete</a>
                        <a href="./edit.php?vaccID=<?= $row["vaccID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Home Page</a>