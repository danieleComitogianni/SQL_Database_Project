<?php require_once '../database.php';

if(isset($_POST["address"]) && isset($_POST["city"])&& isset($_POST["province"])&& isset($_POST["postalCode"])
    && isset($_POST["phoneNumber"])&& isset($_POST["webAddress"])&& isset($_POST["capacity"])
    && isset($_POST["ministryName"])&& isset($_POST["facilityID"])&& isset($_POST["ministryID"])&& isset($_POST["facilityName"])) {
   
    // $checkMinistry = $conn->prepare("SELECT postalCode FROM zcc353_1.address WHERE postalCode = :postalCode");
    // $checkMinistry->bindParam(':postalCode', $_POST["postalCode"]);
    // $checkMinistry->execute();

    // if($checkMinistry->rowCount() == 0) {
    //     $insert = $conn->prepare("INSERT INTO zcc353_1.address (postalCode, city, province) VALUES (:postalCode, :city, :province)");
    //     $insertAddress->bindParam(':postalCode', $_POST["postalCode"]);
    //     $insertAddress->bindParam(':city', $_POST["city"]);
    //     $insertAddress->bindParam(':province', $_POST["province"]);
    //     $insertAddress->execute();
    // }
    
        
   $facility = $conn->prepare("INSERT INTO zcc353_1.facility (address,city,province,postalCode,phoneNumber,webAddress,capacity,ministryName,facilityID,ministryID,facilityName)
                    VALUES (:address, :city, :province, :postalCode, :phoneNumber, :webAddress, :capacity, :ministryName, :facilityID, :ministryID, :facilityName);");

    
    $facility->bindParam(':address',$_POST["address"]);
    $facility->bindParam(':city',$_POST["city"]);
    $facility->bindParam(':province',$_POST["province"]);
    $facility->bindParam(':postalCode',$_POST["postalCode"]);
    $facility->bindParam(':phoneNumber',$_POST["phoneNumber"]);
    $facility->bindParam(':webAddress',$_POST["webAddress"]);
    $facility->bindParam(':capacity',$_POST["capacity"]);
    $facility->bindParam(':ministryName',$_POST["ministryName"]);
    $facility->bindParam(':facilityID',$_POST["facilityID"]);
    $facility->bindParam(':ministryID',$_POST["ministryID"]);
    $facility->bindParam(':facilityName',$_POST["facilityName"]);


    
    if($facility->execute()) {
        header("Location: index.php");
    } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Facility</title>
</head>
<body>
    <h1>ADD Facility</h1>
    <form action="./create.php" method="post">
        <label for="ministryID">Ministry</label><br>
        <input type="number" name = "ministryID" id="ministryID"><br>
        <label for="facilityID">Facility ID</label><br>
        <input type="number" name = "facilityID" id="facilityID"><br>
        <label for="facilityName">Facility Name</label><br>
        <input type="text" name = "facilityName" id="facilityName"><br>
        <label for="ministryName">Ministry Name</label><br>
        <input type="text" name = "ministryName" id="ministryName"><br>
        <label for="address">Address</label><br>
        <input type="text" name = "address" id="address"><br>
        <label for="city">City</label><br>
        <input type="text" name = "city" id="city"><br>
        <label for="province">Province</label><br>
        <input type="text" name = "province" id="province"><br>
        <label for="postalCode">Postal Code</label><br>
        <input type="text" name = "postalCode" id="postalCode"><br>
        <label for="webAddress">Web Address</label><br>
        <input type="text" name = "webAddress" id="webAddress"><br>
        <label for="phoneNumber">Phone Number</label><br>
        <input type="text" name = "phoneNumber" id="phoneNumber"><br>
        <label for="capacity">Capacity</label><br>
        <input type="number" name = "capacity" id="capacity"><br>
        
        <button type = "submit">Add</button>
    </form>
    <a href="./">Back to Student</a>
</body>
</html>