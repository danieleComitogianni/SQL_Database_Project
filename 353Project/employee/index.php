<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM zcc353_1.employee AS employee');
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
    <h1>List of Employees</h1>
    <a href="./create.php">Add New Employee</a>
    <table>
        <thead>
            <tr>
                <td>Employee ID</td>
                <td>Med ID</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["empID"] ?></td>
                    <td><?= $row["medID"] ?></td>
                    <td>
                        <a href="./display.php?medID=<?= $row["medID"] ?>">Display</a>
                        <a href="./delete.php?medID=<?= $row["medID"] ?>">Delete</a>
                        <a href="./edit.php?medID= <?= $row["medID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Home Page</a>
</body>
</html>