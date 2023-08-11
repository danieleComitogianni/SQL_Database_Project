<?php require_once "../database.php";

$statement = $conn->prepare("DELETE FROM zcc353_1.person WHERE person.medID=:medID;");
$statement->bindParam(":medID", $_GET["medID"]);
$statement->execute();
header("Location: .");
?>