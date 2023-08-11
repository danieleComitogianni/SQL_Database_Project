<?php require_once '../database.php';
// if ($conn->getAttribute(PDO::ATTR_AUTOCOMMIT)) {
//     echo "Autocommit is enabled!";
// } else {
//     echo "Autocommit is disabled!";
// }

$statement=$conn->prepare("SELECT * FROM zcc353_1.facility AS facility WHERE facility.facilityID=:facilityID");
$facilityID = $_POST["facilityID"] ?? ($_GET["facilityID"] ?? null);



$statement->bindParam(":facilityID", $facilityID, PDO::PARAM_STR);
$statement->execute();
// if ($statement->rowCount() > 0) {
//     echo "Record updated successfully!";
// } else {
//     echo "No record was updated. Check if the values were different or if there was an error.";
//     print_r($statement->errorInfo());
// }


$facility = $statement->fetch(PDO::FETCH_ASSOC);
if(!$facility){
    die('No record found for specified medID');
}

if(isset($_POST["address"]) && isset($_POST["city"])&& isset($_POST["province"])&& isset($_POST["postalCode"])
    && isset($_POST["phoneNumber"])&& isset($_POST["webAddress"])&& isset($_POST["capacity"])
    && isset($_POST["ministryName"])&& isset($_POST["facilityID"])&& isset($_POST["ministryID"])&& isset($_POST["facilityName"])) {
   
        
        
   $facilityUpdate = $conn->prepare("UPDATE zcc353_1.facility SET address=:address, city=:city, province=:province, postalCode=:postalCode,phoneNumber=:phoneNumber, webAddress=:webAddress, capacity=:capacity, ministryName=:ministryName, ministryID=:ministryID, facilityName=:facilityName WHERE facilityID=:facilityID;");

    
   
   $facilityUpdate->bindParam(':address',$_POST["address"]);
   $facilityUpdate->bindParam(':city',$_POST["city"]);
   $facilityUpdate->bindParam(':province',$_POST["province"]);
   $facilityUpdate->bindParam(':postalCode',$_POST["postalCode"]);
   $facilityUpdate->bindParam(':phoneNumber',$_POST["phoneNumber"]);
   $facilityUpdate->bindParam(':webAddress',$_POST["webAddress"]);
   $facilityUpdate->bindParam(':capacity',$_POST["capacity"]);
   $facilityUpdate->bindParam(':ministryName',$_POST["ministryName"]);
   $facilityUpdate->bindParam(':facilityID',$_POST["facilityID"]);
   $facilityUpdate->bindParam(':ministryID',$_POST["ministryID"]);
   $facilityUpdate->bindParam(':facilityName',$_POST["facilityName"]);

    

    
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
    if($facilityUpdate->execute()) {
        header("Location: index.php");
    } else {
        header("Location: ./edit.php?facilityID=".$_POST["facilityID"]);
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
    <h1>Edit Facility</h1>
    <form action="./edit.php" method="post">
        <label for="ministryID">Ministry ID</label><br>
        <input type="number" name = "ministryID" id="ministryID" value="<?=$facility["ministryID"]?>"> <br>
        <label for="facilityName">Facility Name</label><br>
        <input type="text" name = "facilityName" id="facilityName" value="<?=$facility["facilityName"]?>"> <br>
        <label for="ministryName">Ministry Name</label><br>
        <input type="text" name = "ministryName" id="ministryName" value="<?=$facility["ministryName"]?>"> <br>
        <label for="address">Address</label><br>
        <input type="text" name = "address" id="address" value="<?=$facility["address"]?>"> <br>
        <label for="city">City</label><br>
        <input type="text" name = "city" id="city" value="<?=$facility["city"]?>"> <br>
        <label for="province">Province</label><br>
        <input type="text" name = "province" id="province" value="<?=$facility["province"]?>"> <br>
        <label for="postalCode">Postal Code</label><br>
        <input type="text" name = "postalCode" id="postalCode" value="<?=$facility["postalCode"]?>"> <br>
       <label for="webAddress">Web Address</label><br>
        <input type="text" name = "webAddress" id="webAddress" value="<?=$facility["webAddress"]?>"> <br>
        <label for="phoneNumber">Phone Number</label><br>
        <input type="text" name = "phoneNumber" id="phoneNumber" value="<?=$facility["phoneNumber"]?>"> <br>
        <label for="capacity">Capacity</label><br>
        <input type="number" name = "capacity" id="capacity" value="<?=$facility["capacity"]?>"> <br>
        <input type="hidden" name="facilityID" value="<?= $facilityID ?>">
        
        <button type = "submit">Edit</button>
    </form>
    <a href="./">Back to Person</a>
</body>
</html>