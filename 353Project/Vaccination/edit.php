<?php require_once '../database.php';
// if ($conn->getAttribute(PDO::ATTR_AUTOCOMMIT)) {
//     echo "Autocommit is enabled!";
// } else {
//     echo "Autocommit is disabled!";
// }

$statement=$conn->prepare("SELECT * FROM zcc353_1.vaccinations AS vaccinations WHERE vaccinations.vaccID = :vaccID");
$vaccID = $_POST["vaccID"] ?? ($_GET["vaccID"] ?? null);



$statement->bindParam(":vaccID", $vaccID, PDO::PARAM_INT);
$statement->execute();



$vax = $statement->fetch(PDO::FETCH_ASSOC);
if(!$vax){
    die('No record found for specified medID');
}

if(isset($_POST["vaccID"]) && isset($_POST["medID"])&& isset($_POST["typeOfVaccination"])&& isset($_POST["vaccinationDate"])
    && isset($_POST["numberOfDoses"])) {
   
        
        
   $statement = $conn->prepare("UPDATE zcc353_1.vaccinations SET medID=:medID, typeOfVaccination=:typeOfVaccination, vaccinationDate=:vaccinationDate, numberOfDoses=:numberOfDoses WHERE vaccID=:vaccID;");

    
   
    $statement->bindParam(':medID',$_POST["medID"]);
    $statement->bindParam(':typeOfVaccination',$_POST["typeOfVaccination"]);
    $statement->bindParam(':vaccinationDate',$_POST["vaccinationDate"]);
    $statement->bindParam(':numberOfDoses',$_POST["numberOfDoses"]);
    $statement->bindParam(':vaccID',$vaccID);

    

    if($statement->execute()) {
        header("Location: .");
    } else {
        header("Location: ./edit.php?vaccID=".$_POST["vaccID"]);
    } 
    

   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vaccination Logs</title>
</head>
<body>
    <h1>Edit Vaccination Record</h1>
    <form action="./edit.php" method="post">
        <label for="medID">Medical ID</label><br>
        <input type="text" name = "medID" id="medID" value="<?=$vax["medID"]?>"> <br>
        <input type="hidden" name="vaccID" value="<?= $vaccID ?>">
        <label for="typeOfVaccination">Type Of Vaccination</label><br>
        <input type="text" name = "typeOfVaccination" id="typeOfVaccination" value="<?=$vax["typeOfVaccination"]?>"> <br>
        <label for="vaccinationDate">Vaccination Date</label><br>
        <input type="date" name = "vaccinationDate" id="vaccinationDate" value="<?=$vax["vaccinationDate"]?>"> <br>
        <label for="numberOfDoses">Number Of Doses</label><br>
        <input type="number" name = "numberOfDoses" id="numberOfDoses" value="<?=$vax["numberOfDoses"]?>"> <br>
        <button type = "submit">Edit</button>
    </form>
    <a href="./">Back to Person</a>
</body>
</html>