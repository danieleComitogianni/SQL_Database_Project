<?php
require_once '../database.php';

if (isset($_GET["facilityID"])) {
    $facilityID = $_GET["facilityID"];

    $statement = $conn->prepare('
        SELECT 
            roleType AS "Role",
            fName AS "First Name",
            lName AS "Last Name",
            startDate AS "Start Date of Work",
            dateOfBirth AS "Date of Birth",
            medID AS "Medicare Card Number",
            phoneNumber AS "Telephone Number",
            address AS "Address",
            postalCode AS "Postal Code",
            citizenship AS "Citizenship",
            email AS "Email Address"
        FROM vemployeeCurrentInfo
        WHERE facilityID = :facilityID
        ORDER BY roleType ASC, fName ASC, lName ASC;
    ');
    $statement->bindParam(':facilityID', $facilityID);
    $statement->execute();
} else {
    die("FacilityID not provided in the URL.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees of Facility <?= $facilityID ?></title>
</head>

<body>
    <h1>Employees of Facility <?= $facilityID ?></h1>
    <table>
        <thead>
            <tr>
                <!-- You can adjust these headers based on the data you're fetching -->
                <td>Role</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Start Date of Work</td>
                <td>Date of Birth</td>
                <td>Medicare Card Number</td>
                <td>Telephone Number</td>
                <td>Address</td>
                <td>Postal Code</td>
                <td>Citizenship</td>
                <td>Email Address</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["Role"] ?></td>
                    <td><?= $row["First Name"] ?></td>
                    <td><?= $row["Last Name"] ?></td>
                    <td><?= $row["Start Date of Work"] ?></td>
                    <td><?= $row["Date of Birth"] ?></td>
                    <td><?= $row["Medicare Card Number"] ?></td>
                    <td><?= $row["Telephone Number"] ?></td>
                    <td><?= $row["Address"] ?></td>
                    <td><?= $row["Postal Code"] ?></td>
                    <td><?= $row["Citizenship"] ?></td>
                    <td><?= $row["Email Address"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="./">Back to Facilities</a>
</body>

</html>
