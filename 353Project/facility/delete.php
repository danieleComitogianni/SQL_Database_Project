<?php require_once "../database.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_GET["facilityID"])) {

    echo "facilityID from GET: " . $_GET["facilityID"] . "<br>";

    $statement = $conn->prepare("DELETE FROM zcc353_1.facility WHERE facility.facilityID=:facilityID;");
    $statement->bindParam(":facilityID", $_GET["facilityID"]);

    if($statement->execute()) {
        echo "Rows deleted: " . $statement->rowCount() . "<br>";
        header("Location: .");
    } else {
        $error = $statement->errorInfo();
        echo "SQL Error: " . $error[2];
    }

} else {
    echo "facilityID is not set in the URL.";
}
 

?> 