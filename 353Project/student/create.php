<?php require_once '../database.php';

if(isset($_POST["studentID"]) && isset($_POST["medID"])) {
    $student = $conn->prepare("INSERT INTO student (studentID,medID)
                    VALUES (:studentID, :medID)");

$student->bindParam(':studentID', $_POST["studentID"], PDO::PARAM_INT);
$student->bindParam(':medID', $_POST["medID"], PDO::PARAM_STR);


    
echo "StudentID: " . $_POST["studentID"] . "<br>";
echo "MedID: " . $_POST["medID"] . "<br>";    
if($student->execute()) {
        header("Location: .");
    } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
<body>
    <form action="./create.php" method="post">
        <label for="studentID">Student ID</label><br>
        <input type="number" name = "studentID" id="studentID"><br>
        <label for="medID">Medical ID</label><br>
        <input type="text" name = "medID" id="medID"><br>
        <button type = "submit">Add</button>
    </form>
    <a href="./">Back to Student</a>
</body>
</html>