<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM zcc353_1.facility AS facility');
$statement->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility</title>
</head>
<body>
    <h1>Facilities</h1>
    <a href="./create.php">Add New Facility</a>
    <table>
        <thead>
            <tr>
                <td>Ministry ID</td>
                <td>Facility ID</td>
                <td>Facility Name</td>
                <td>Ministry Name</td>
                <td>Address</td>
                <td>City</td>
                <td>Province</td>
                <td>Postal Code</td>
                <td>Web Address</td>
                <td>Phone Number</td>
                <td>Capacity</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["ministryID"] ?></td>
                    <td><?= $row["facilityID"] ?></td>
                    <td><?= $row["facilityName"] ?></td>
                    <td><?= $row["ministryName"] ?></td>
                    <td><?= $row["address"] ?></td>
                    <td><?= $row["city"] ?></td>
                    <td><?= $row["province"] ?></td>
                    <td><?= $row["postalCode"] ?></td>
                    <td><?= $row["webAddress"] ?></td>
                    <td><?= $row["phoneNumber"] ?></td>
                    <td><?= $row["capacity"] ?></td>
                    <td>
                    
                        <a href="./displayEmployees.php?facilityID=<?= $row["facilityID"] ?>">Display</a>
                        <a href="./delete.php?facilityID=<?= $row["facilityID"] ?>">Delete</a>
                        <a href="./edit.php?facilityID=<?= $row["facilityID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Home Page</a>
</body>
</html>