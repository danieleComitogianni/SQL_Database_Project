<?php require_once '../database.php';

if(isset($_POST["vaccID"]) && isset($_POST["medID"])) {
    $vax = $conn->prepare("INSERT INTO vaccinations (vaccID,medID,typeOfVaccination, vaccinationDate, numberOfDoses)
                    VALUES (:vaccID, :medID, :typeOfVaccination, :vaccinationDate, :numberOfDoses)");

$vax->bindParam(':vaccID', $_POST["vaccID"], PDO::PARAM_INT);
$vax->bindParam(':medID', $_POST["medID"], PDO::PARAM_STR);
$vax->bindParam(':typeOfVaccination', $_POST["typeOfVaccination"], PDO::PARAM_STR);
$vax->bindParam(':vaccinationDate', $_POST["vaccinationDate"], PDO::PARAM_STR);
$vax->bindParam(':numberOfDoses', $_POST["numberOfDoses"], PDO::PARAM_STR);


    
   
if($vax->execute()) {
        header("Location: .");
    } 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vaccine Log</title>
</head>
<body>
    <form action="./create.php" method="post">
        <label for="medID">Medical ID</label><br>
        <input type="text" name = "medID" id="medID"><br>
        <label for="vaccID">Vaccination ID</label><br>
        <input type="number" name = "vaccID" id="vaccID"><br>
        <label for="typeOfVaccination">Type of Vaccination</label><br>
        <input type="text" name = "typeOfVaccination" id="typeOfVaccination"><br>
        <label for="vaccinationDate">Vaccination Date</label><br>
        <input type="date" name = "vaccinationDate" id="vaccinationDate"><br>
        <label for="numberOfDoses">Number Of Doses</label><br>
        <input type="number" name = "numberOfDoses" id="numberOfDoses"><br>
        <button type = "submit">Add</button>
    </form>
    <a href="./">Back to Student</a>
</body>
</html>