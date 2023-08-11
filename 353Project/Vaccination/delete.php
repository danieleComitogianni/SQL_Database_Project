<?php require_once "../database.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_GET["vaccID"])) {

    echo "vaccID from GET: " . $_GET["vaccID"] . "<br>";

    $statement = $conn->prepare("DELETE FROM zcc353_1.vaccinations WHERE vaccinations.vaccID=:vaccID;");
    $statement->bindParam(":vaccID", $_GET["vaccID"]);

    if($statement->execute()) {
        echo "Rows deleted: " . $statement->rowCount() . "<br>";
        header("Location: .");
    } else {
        $error = $statement->errorInfo();
        echo "SQL Error: " . $error[2];
    }

} else {
    echo "vaccID is not set in the URL.";
}
 

?> 