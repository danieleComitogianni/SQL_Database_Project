<?php require_once '../database.php';

if(isset($_POST["empID"]) && isset($_POST["medID"])) {
    $employee = $conn->prepare("INSERT INTO employee (empID,medID)
                    VALUES (:empID, :medID)");

$employee->bindParam(':empID', $_POST["empID"], PDO::PARAM_INT);
$employee->bindParam(':medID', $_POST["medID"], PDO::PARAM_STR);


    
    
if($employee->execute()) {
        header("Location: .");
    } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
</head>
<body>
    <form action="./create.php" method="post">
        <label for="studentID">Employee ID</label><br>
        <input type="number" name = "empID" id="empID"><br>
        <label for="medID">Medical ID</label><br>
        <input type="text" name = "medID" id="medID"><br>
        <button type = "submit">Add</button>
    </form>
    <a href="./">Back to Student</a>
</body>
</html>