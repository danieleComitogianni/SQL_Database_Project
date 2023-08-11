<?php require_once '../database.php';
// if ($conn->getAttribute(PDO::ATTR_AUTOCOMMIT)) {
//     echo "Autocommit is enabled!";
// } else {
//     echo "Autocommit is disabled!";
// }

$statement=$conn->prepare("SELECT * FROM zcc353_1.infections AS infections WHERE infections.infecID = :infecID");
$infecID = $_POST["infecID"] ?? ($_GET["infecID"] ?? null);



$statement->bindParam(":infecID", $infecID, PDO::PARAM_INT);
$statement->execute();



$infection = $statement->fetch(PDO::FETCH_ASSOC);
if(!$infection){
    die('No record found for specified medID');
}

if(isset($_POST["infecID"]) && isset($_POST["medID"])&& isset($_POST["typeOfInfection"])&& isset($_POST["dateOfInfection"])) {
   
        
        
   $statement = $conn->prepare("UPDATE zcc353_1.infections SET medID=:medID, typeOfInfection=:typeOfInfection, dateOfInfection=:dateOfInfection WHERE infecID=:infecID;");

    
   
    $statement->bindParam(':medID',$_POST["medID"]);
    $statement->bindParam(':typeOfInfection',$_POST["typeOfInfection"]);
    $statement->bindParam(':dateOfInfection',$_POST["dateOfInfection"]);
    $statement->bindParam(':infecID',$infecID);

    

    if($statement->execute()) {
        header("Location: .");
    } else {
        header("Location: ./edit.php?infecID=".$_POST["infecID"]);
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
        <input type="text" name = "medID" id="medID" value="<?=$infection["medID"]?>"> <br>
        <input type="hidden" name="infecID" value="<?= $infecID ?>">
        <label for="typeOfInfection">Type Of Infection</label><br>
        <input type="text" name = "typeOfInfection" id="typeOfInfection" value="<?=$infection["typeOfInfection"]?>"> <br>
        <label for="dateOfInfection">Infection Date</label><br>
        <input type="date" name = "dateOfInfection" id="dateOfInfection" value="<?=$infection["dateOfInfection"]?>"> <br>
        <button type = "submit">Edit</button>
    </form>
    <a href="./">Back to Person</a>
</body>
</html>