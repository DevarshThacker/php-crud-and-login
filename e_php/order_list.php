<?php
include "config.php";

// Use backticks to escape the table name 'order' since it's a reserved keyword
$data_query = "SELECT * FROM `order`";
$result = $conn->query($data_query);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} 
echo json_encode(['data' => $data]);
?>
