<?php 
require_once '../database.php';

$results = [];

if(isset($_POST["date"]) && isset($_POST["startTime"]) && isset($_POST["endTime"])) {
    $date = $_POST["date"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];

    // Fetching schedules that match the input date and time range
    $scheduleCheck = $conn->prepare("SELECT empID, startTime, endTime FROM zcc353_1.schedule WHERE date = :date AND 
                                    ((startTime >= :startTime AND startTime <= :endTime) OR 
                                     (endTime >= :startTime AND endTime <= :endTime))");
    $scheduleCheck->bindParam(':date', $date);
    $scheduleCheck->bindParam(':startTime', $startTime);
    $scheduleCheck->bindParam(':endTime', $endTime);
    $scheduleCheck->execute();
    
    $results = $scheduleCheck->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Schedule Search</title>
</head>
<body>
    <h1>Employee Schedule Search</h1>
    <form action="./search.php" method="post">
        <label for="date">Date</label><br>
        <input type="date" name="date" id="date"><br>
        <label for="startTime">Start Time</label><br>
        <input type="time" name="startTime" id="startTime"><br>
        <label for="endTime">End Time</label><br>
        <input type="time" name="endTime" id="endTime"><br>
        <button type="submit">Search</button>
    </form>
    <a href="./">Back to Schedule</a>
    <h2>Search Results:</h2>
    <table>
        <tr>
            <th>Employee ID</th>
            <th>Start Time</th>
            <th>End Time</th>
        </tr>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?php echo $row['empID']; ?></td>
                <td><?php echo $row['startTime']; ?></td>
                <td><?php echo $row['endTime']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>