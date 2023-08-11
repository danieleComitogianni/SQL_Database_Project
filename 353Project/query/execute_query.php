<?php
// This file processes the SQL query and then outputs the results.

require_once '../database.php'; // Your PDO database connection file

$query = $_POST['sql_query'] ?? '';

$result = [];

try {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query error: " . $e->getMessage());
}

echo "<table border='1'>";

// Check if result is not empty
if ($result && count($result) > 0) {
    // Table Headers
    $columns = array_keys($result[0]);
    echo "<tr>";
    foreach ($columns as $col) {
        echo "<th>$col</th>";
    }
    echo "</tr>";

    // Table Data
    foreach ($result as $row) {
        echo "<tr>";
        foreach ($columns as $col) {
            echo "<td>" . htmlspecialchars($row[$col]) . "</td>";
        }
        echo "</tr>";
    }
} else {
    echo "<tr><td>No results found</td></tr>";
}

echo "</table>";
?>
