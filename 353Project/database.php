<?php
$server = "zcc353.encs.concordia.ca";
$username = 'zcc353_1';
$password = 'd10s8z88';
$database = 'zcc353_1';
// $server = "localhost:3306";
// $username = 'root';
// $password = '';
// $database = 'comp353';

try{
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e){
    die('connection failed! ' .$e->getMessage());
}

?>