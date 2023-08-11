<?php require_once "../database.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_GET["infecID"])) {

    echo "infecID from GET: " . $_GET["infecID"] . "<br>";

    $statement = $conn->prepare("DELETE FROM zcc353_1.infections WHERE infections.infecID=:infecID;");
    $statement->bindParam(":infecID", $_GET["infecID"]);

    if($statement->execute()) {
        echo "Rows deleted: " . $statement->rowCount() . "<br>";
        header("Location: .");
    } else {
        $error = $statement->errorInfo();
        echo "SQL Error: " . $error[2];
    }

} else {
    echo "infecID is not set in the URL.";
}
 

?> 