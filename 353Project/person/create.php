<?php require_once '../database.php';

if(isset($_POST["medID"]) && isset($_POST["fName"])&& isset($_POST["lName"])&& isset($_POST["dateOfBirth"])
    && isset($_POST["phoneNumber"])&& isset($_POST["address"])&& isset($_POST["postalCode"])
    && isset($_POST["citizenship"])&& isset($_POST["email"])&& isset($_POST["medExp"])) {
   
    $checkPostalCode = $conn->prepare("SELECT postalCode FROM zcc353_1.address WHERE postalCode = :postalCode");
    $checkPostalCode->bindParam(':postalCode', $_POST["postalCode"]);
    $checkPostalCode->execute();

    if($checkPostalCode->rowCount() == 0) {
        $insertAddress = $conn->prepare("INSERT INTO zcc353_1.address (postalCode, city, province) VALUES (:postalCode, :city, :province)");
        $insertAddress->bindParam(':postalCode', $_POST["postalCode"]);
        $insertAddress->bindParam(':city', $_POST["city"]);
        $insertAddress->bindParam(':province', $_POST["province"]);
        $insertAddress->execute();
    }
    
        
   $person = $conn->prepare("INSERT INTO zcc353_1.person (medID,fName,lName,dateOfBirth,phoneNumber,address,postalCode,citizenship,email,medExp)
                    VALUES (:medID, :fName, :lName, :dateOfBirth, :phoneNumber, :address, :postalCode, :citizenship, :email, :medExp);");

    
    $person->bindParam(':medID',$_POST["medID"]);
    $person->bindParam(':fName',$_POST["fName"]);
    $person->bindParam(':lName',$_POST["lName"]);
    $person->bindParam(':dateOfBirth',$_POST["dateOfBirth"]);
    $person->bindParam(':phoneNumber',$_POST["phoneNumber"]);
    $person->bindParam(':address',$_POST["address"]);
    $person->bindParam(':postalCode',$_POST["postalCode"]);
    $person->bindParam(':citizenship',$_POST["citizenship"]);
    $person->bindParam(':email',$_POST["email"]);
    $person->bindParam(':medExp',$_POST["medExp"]);


    
    if($person->execute()) {
        header("Location: index.php");
    } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Person</title>
</head>
<body>
    <h1>ADD Person</h1>
    <form action="./create.php" method="post">
        <label for="medID">Medical ID</label><br>
        <input type="text" name = "medID" id="medID"><br>
        <label for="fName">First Name</label><br>
        <input type="text" name = "fName" id="fName"><br>
        <label for="lName">Last Name</label><br>
        <input type="text" name = "lName" id="lName"><br>
        <label for="dateOfBirth">Date Of Birth</label><br>
        <input type="date" name = "dateOfBirth" id="dateOfBirth"><br>
        <label for="phoneNumber">Phone Number</label><br>
        <input type="text" name = "phoneNumber" id="phoneNumber"><br>
        <label for="address">Address</label><br>
        <input type="text" name = "address" id="address"><br>
        <label for="postalCode">Postal Code</label><br>
        <input type="text" name = "postalCode" id="postalCode"><br>
        <label for="citizenship">Citizenship</label><br>
        <input type="text" name = "citizenship" id="citizenship"><br>
        <label for="email">Email</label><br>
        <input type="text" name = "email" id="email"><br>
        <label for="medExp">medical Card Expiry</label><br>
        <input type="date" name = "medExp" id="medExp"><br>
        <label for="city">City</label><br>
        <input type="text" name="city" id="city"><br>
        <label for="province">Province</label><br>
        <input type="text" name="province" id="province"><br>

        
        <button type = "submit">Add</button>
    </form>
    <a href="./">Back to Student</a>
</body>
</html>