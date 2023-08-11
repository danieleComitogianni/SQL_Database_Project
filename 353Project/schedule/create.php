<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../database.php';

$error = "";

if(isset($_POST["date"]) && isset($_POST["startTime"]) && isset($_POST["endTime"]) && isset($_POST["empID"])) {

    $date = $_POST["date"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
    $empID = $_POST["empID"];

    // Check if the employee ID is in the employee table
    $employeeCheck = $conn->prepare("SELECT * FROM employee WHERE empID = :empID");
    $employeeCheck->bindParam(':empID', $empID);
    $employeeCheck->execute();
    
    if($employeeCheck->rowCount() == 0) {
        $error = "Employee ID not found!";
    } elseif ($startTime >= $endTime) {
        $error = "Start time must be less than end time!";
    } elseif (strtotime($date) > strtotime('+4 weeks')) {
        $error = "Cannot schedule more than 4 weeks in advance!";
    } else {
        // Check conflicting times
        $conflictCheck = $conn->prepare("SELECT * FROM zcc353_1.schedule WHERE empID = :empID AND date = :date AND 
                                        ((startTime <= :startTime AND endTime > :startTime) OR 
                                         (startTime < :endTime AND endTime >= :endTime))");
        $conflictCheck->bindParam(':empID', $empID);
        $conflictCheck->bindParam(':date', $date);
        $conflictCheck->bindParam(':startTime', $startTime);
        $conflictCheck->bindParam(':endTime', $endTime);
        $conflictCheck->execute();

        if ($conflictCheck->rowCount() > 0) {
            $error = "Conflicting schedule for the same employee!";
        } else {
            $schedule = $conn->prepare("INSERT INTO zcc353_1.schedule (date, startTime, endTime, empID)
                                        VALUES (:date, :startTime, :endTime, :empID)");
            $schedule->bindParam(':date', $date);
            $schedule->bindParam(':startTime', $startTime);
            $schedule->bindParam(':endTime', $endTime);
            $schedule->bindParam(':empID', $empID);
            
            if($schedule->execute()) {
                header("Location: index.php");
            } else {
                $error = "Error: " . $schedule->errorCode();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Schedule</title>
</head>
<body>
    <h1>Add Schedule</h1>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="./create.php" method="post">
        <label for="date">Date</label><br>
        <input type="date" name="date" id="date"><br>
        <label for="startTime">Start Time</label><br>
        <input type="time" name="startTime" id="startTime"><br>
        <label for="endTime">End Time</label><br>
        <input type="time" name="endTime" id="endTime"><br>
        <label for="empID">Employee ID</label><br>
        <input type="number" name="empID" id="empID"><br>
        <button type="submit">Add</button>
    </form>
    <a href="./">Back to Schedule</a>
</body>
</html>