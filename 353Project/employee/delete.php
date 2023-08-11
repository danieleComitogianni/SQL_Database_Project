<?php require_once "../database.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_GET["medID"])) {

    echo "medID from GET: " . $_GET["medID"] . "<br>";

    $statement = $conn->prepare("DELETE FROM zcc353_1.employee WHERE employee.medID=:medID;");
    $statement->bindParam(":medID", $_GET["medID"]);

    if($statement->execute()) {
        echo "Rows deleted: " . $statement->rowCount() . "<br>";
        header("Location: .");
    } else {
        $error = $statement->errorInfo();
        echo "SQL Error: " . $error[2];
    }

} else {
    echo "medID is not set in the URL.";
}
 

?> 