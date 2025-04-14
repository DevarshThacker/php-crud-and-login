<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $sku = isset($_POST['sku']) ? $_POST['sku'] : '';
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $stoke = $_POST['stoke'];
    $vander_name = $_POST['vander_name'];
    
    $product_images = $_FILES['image']['name'];
    $temp_images = $_FILES['image']['tmp_name'];
    $images=[];
    $image_paths = [];

    foreach ($product_images as $index => $image) {
        $image_path = "../prodimg/" . $image;
        move_uploaded_file($temp_images[$index], $image_path);
        $image_paths[] = $image_path;
        $images[]=$image;
    }

    $image_string = implode(",", $images);

    $query = "INSERT INTO product (sku, product_title, product_description, stoke, vander_name, product_images) 
              VALUES ('$sku', '$product_title', '$product_description', '$stoke', '$vander_name', '$image_string')";

    if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
