<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['sku'])) $sku = $_POST['sku'];
    // if (isset($_POST['product_title'])) $product_title = $_POST['product_title'];
    // if (isset($_POST['product_description'])) $product_description = $_POST['product_description'];
    // if (isset($_POST['stoke'])) $stoke = $_POST['stoke'];
    // if (isset($_POST['vander_name'])) $vander_name = $_POST['vander_name'];
    // if (isset($_POST['image'])) $image = $_POST['image'];
    
    $column = $_POST['column'];
    $value = $_POST['value'];

    // Validate column name to prevent SQL injection
    $allowed_columns = ['sku', 'product_title', 'product_description', 'stoke', 'vander_name'];
    if (!in_array($column, $allowed_columns)) {
        echo "Invalid column name";
        exit;
    }

    // Escape values to prevent SQL injection
    $sku = mysqli_real_escape_string($conn, $sku);
    // $product_title = mysqli_real_escape_string($conn, $product_title);
    // $product_description = mysqli_real_escape_string($conn, $product_description);
    // $stoke = mysqli_real_escape_string($conn, $stoke);
    // $vander_name = mysqli_real_escape_string($conn, $vander_name);
    $value = mysqli_real_escape_string($conn, $value);

    $sql = "UPDATE product SET $column = '$value' WHERE sku = '$sku'";
    // $sql = "UPDATE `product` SET `sku`='$sku', `product_title`='$product_title', `product_description`='$product_description', `stoke`='$stoke', `vander_name`='$vander_name' WHERE sku='$sku'";


    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>