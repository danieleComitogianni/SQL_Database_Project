<?php require_once '../database.php';
// if ($conn->getAttribute(PDO::ATTR_AUTOCOMMIT)) {
//     echo "Autocommit is enabled!";
// } else {
//     echo "Autocommit is disabled!";
// }

$statement=$conn->prepare("SELECT * FROM zcc353_1.student AS student WHERE student.medID=:medID");
$medID = trim($_POST["medID"] ?? ($_GET["medID"] ?? null));



$statement->bindParam(":medID", $medID, PDO::PARAM_STR);
$statement->execute();
// if ($statement->rowCount() > 0) {
//     echo "Record updated successfully!";
// } else {
//     echo "No record was updated. Check if the values were different or if there was an error.";
//     print_r($statement->errorInfo());
// }


$student = $statement->fetch(PDO::FETCH_ASSOC);
if(!$student){
    die('No record found for specified medID');
}

if(isset($_POST["medID"]) && isset($_POST["studentID"])) {
   
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        
   $statement = $conn->prepare("UPDATE zcc353_1.student SET studentID= :studentID WHERE medID=:medID;");

    
   
    $statement->bindParam(':studentID',$_POST["studentID"]);
    $statement->bindParam(':medID',$medID);

    echo $statement->queryString;

    
    // if ($statement->execute()) {
    //     // Check if any rows were affected
    //     if ($statement->rowCount() > 0) {
    //         echo "Record updated successfully!";
    //     } else {
    //         echo "No rows were updated!";
    //     }
    // } else {
    //     // Print any error information
    //     $error = $statement->errorInfo();
    //     echo "Error: " . $error[2];
    // } 
    if($statement->execute()) {
        header("Location: .");
    } else {
        header("Location: ./edit.php?medID=".$_POST["medID"]);
    } 
    

   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <form action="./edit.php" method="post">
        <label for="studentID">Student ID</label><br>
        <input type="number" name = "studentID" id="studentID" value="<?=$student["studentID"]?>"> <br>
        <input type="hidden" name="medID" value="<?= $medID ?>">
        <button type = "submit">Edit</button>
    </form>
    <a href="./">Back to Person</a>
</body>
</html>