<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    // First, delete related records from ord_address
    $address_query = "DELETE FROM `ord_address` WHERE ord_id = '$id'";
    if ($conn->query($address_query) === TRUE) {
        // Now delete the order
        $query = "DELETE FROM `order` WHERE id = '$id'";
        if ($conn->query($query) === TRUE) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }
        
    } else {
        echo json_encode(['status' => false]);
    }
}
?>