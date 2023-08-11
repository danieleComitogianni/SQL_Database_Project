<?php require_once '../database.php';
// if ($conn->getAttribute(PDO::ATTR_AUTOCOMMIT)) {
//     echo "Autocommit is enabled!";
// } else {
//     echo "Autocommit is disabled!";
// }

$statement=$conn->prepare("SELECT * FROM zcc353_1.person AS person WHERE person.medID=:medID");
$medID = $_POST["medID"] ?? ($_GET["medID"] ?? null);



$statement->bindParam(":medID", $medID, PDO::PARAM_STR);
$statement->execute();
// if ($statement->rowCount() > 0) {
//     echo "Record updated successfully!";
// } else {
//     echo "No record was updated. Check if the values were different or if there was an error.";
//     print_r($statement->errorInfo());
// }


$person = $statement->fetch(PDO::FETCH_ASSOC);
if(!$person){
    die('No record found for specified medID');
}

if(isset($_POST["medID"]) && isset($_POST["fName"])&& isset($_POST["lName"])&& isset($_POST["dateOfBirth"])
    && isset($_POST["phoneNumber"])&& isset($_POST["address"])&& isset($_POST["postalCode"])
    && isset($_POST["citizenship"])&& isset($_POST["email"])&& isset($_POST["medExp"])) {
   
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        
   $statement = $conn->prepare("UPDATE zcc353_1.person SET fName=:fName, lName=:lName, dateOfBirth=:dateOfBirth, phoneNumber=:phoneNumber, address=:address, postalCode=:postalCode, citizenship=:citizenship, email=:email, medExp=:medExp WHERE medID=:medID;");

    
   
    $statement->bindParam(':fName',$_POST["fName"]);
    $statement->bindParam(':lName',$_POST["lName"]);
    $statement->bindParam(':dateOfBirth',$_POST["dateOfBirth"]);
    $statement->bindParam(':phoneNumber',$_POST["phoneNumber"]);
    $statement->bindParam(':address',$_POST["address"]);
    $statement->bindParam(':postalCode',$_POST["postalCode"]);
    $statement->bindParam(':citizenship',$_POST["citizenship"]);
    $statement->bindParam(':email',$_POST["email"]);
    $statement->bindParam(':medExp',$_POST["medExp"]);
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
    <title>Edit Person</title>
</head>
<body>
    <h1>Edit Person</h1>
    <form action="./edit.php" method="post">
        <label for="fName">First Name</label><br>
        <input type="text" name = "fName" id="fName" value="<?=$person["fName"]?>"> <br>
        <label for="lName">Last Name</label><br>
        <input type="text" name = "lName" id="lName" value="<?=$person["lName"]?>"> <br>
        <label for="dateOfBirth">Date Of Birth</label><br>
        <input type="date" name = "dateOfBirth" id="dateOfBirth" value="<?=$person["dateOfBirth"]?>"> <br>
        <label for="phoneNumber">Phone Number</label><br>
        <input type="text" name = "phoneNumber" id="phoneNumber" value="<?=$person["phoneNumber"]?>"> <br>
        <label for="address">Address</label><br>
        <input type="text" name = "address" id="address" value="<?=$person["address"]?>"> <br>
        <label for="postalCode">Postal Code</label><br>
        <input type="text" name = "postalCode" id="postalCode" value="<?=$person["postalCode"]?>"> <br>
        <label for="citizenship">Citizenship</label><br>
        <input type="text" name = "citizenship" id="citizenship" value="<?=$person["citizenship"]?>"> <br>
        <label for="email">Email</label><br>
        <input type="text" name = "email" id="email" value="<?=$person["email"]?>"> <br>
        <label for="medExp">medical Card Expiry</label><br>
        <input type="date" name = "medExp" id="medExp" value="<?=$person["medExp"]?>"> <br>
        <input type="hidden" name="medID" value="<?= $medID ?>">
        <button type = "submit">Edit</button>
    </form>
    <a href="./">Back to Person</a>
</body>
</html>