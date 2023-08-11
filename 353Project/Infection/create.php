<?php require_once '../database.php';

if(isset($_POST["infecID"]) && isset($_POST["medID"])) {
    $infection = $conn->prepare("INSERT INTO infections (infecID,medID,typeOfInfection, dateOfInfection)
                    VALUES (:infecID, :medID, :typeOfInfection, :dateOfInfection)");

$infection->bindParam(':infecID', $_POST["infecID"], PDO::PARAM_INT);
$infection->bindParam(':medID', $_POST["medID"], PDO::PARAM_STR);
$infection->bindParam(':typeOfInfection', $_POST["typeOfInfection"], PDO::PARAM_STR);
$infection->bindParam(':dateOfInfection', $_POST["dateOfInfection"], PDO::PARAM_STR);


    
   
if($infection->execute()) {
        header("Location: .");
    } 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Infection Log</title>
</head>
<body>
    <form action="./create.php" method="post">
        <label for="infecID">Infection ID</label><br>
        <input type="number" name = "infecID" id="infecID"><br>
        <label for="medID">Medical ID</label><br>
        <input type="text" name = "medID" id="medID"><br>
        <label for="typeOfInfection">Type of Infection</label><br>
        <input type="text" name = "typeOfInfection" id="typeOfInfection"><br>
        <label for="dateOfInfection">Date Of Infection</label><br>
        <input type="date" name = "dateOfInfection" id="dateOfInfection"><br>
        <button type = "submit">Add</button>
    </form>
    <a href="./">Back to Student</a>
</body>
</html>