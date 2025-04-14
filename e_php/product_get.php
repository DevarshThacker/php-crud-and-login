<?php
include "config.php";
$prod_get = "SELECT sku, product_title FROM product";
$result = $conn->query($prod_get);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>