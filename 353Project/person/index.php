<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM zcc353_1.person AS person');
$statement->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person</title>
</head>
<body>
    <h1>List of People</h1>
    <a href="./create.php">Add New Person</a>
    <table>
        <thead>
            <tr>
                <td>Medical ID</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Date Of Birth</td>
                <td>Phone Number</td>
                <td>Address</td>
                <td>Postal Code</td>
                <td>Citizenship</td>
                <td>Email</td>
                <td>Medical Card Expiration Date</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["medID"] ?></td>
                    <td><?= $row["fName"] ?></td>
                    <td><?= $row["lName"] ?></td>
                    <td><?= $row["dateOfBirth"] ?></td>
                    <td><?= $row["phoneNumber"] ?></td>
                    <td><?= $row["address"] ?></td>
                    <td><?= $row["postalCode"] ?></td>
                    <td><?= $row["citizenship"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["medExp"] ?></td>
                    <td>
                    
                        <a href="./display.php?medID=<?= $row["medID"] ?>">Display</a>
                        <a href="./delete.php?medID=<?= $row["medID"] ?>">Delete</a>
                        <a href="./edit.php?medID=<?= $row["medID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Home Page</a>
</body>
</html>