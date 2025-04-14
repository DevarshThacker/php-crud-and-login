<?php 
include "config.php";

$sku = $_POST['sku'];
// Escape the SKU value since it's a string
$sql = "DELETE FROM product WHERE sku = '$sku'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => true]);
} else {
    echo json_encode(['status' => false]);
}

$conn->close();

?>
