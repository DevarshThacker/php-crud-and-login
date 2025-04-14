<?php

include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sku = $_POST['sku'];
    $column = $_POST['column'];  // column is expected to be 'product_images'

    if ($column == 'product_images' && isset($_FILES['image'])) {  // Use 'image' instead of 'value'
        $file = $_FILES['image'];  // Use 'image' instead of 'value'
        $targetDir = "../prodimg/";
        $targetFile = $targetDir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                // Update the database with the new image URL
                $newImageUrl = basename($file["name"]); // Get only the file name
                $query = "UPDATE product SET product_images = '$newImageUrl' WHERE sku = '$sku'";
                if ($conn->query($query) === TRUE) {
                    echo json_encode( $newImageUrl); // Send the new image URL back
                } else {
                    echo json_encode(['error' => 'Failed to update database: ' . $conn->error]);
                }
            } else {
                echo json_encode(['error' => 'Failed to upload file']);
            }
        } else {
            echo json_encode(['error' => 'File is not an image']);
        }
    } else {
        // Handle other column updates (if needed)
        if (isset($_POST['value'])) {
            $value = $_POST['value'];
            $query = "UPDATE product SET $column = '$value' WHERE sku = '$sku'";
            if ($conn->query($query) === TRUE) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'Failed to update database: ' . $conn->error]);
            }
        } else {
            echo json_encode(['error' => 'Missing "value" parameter']);
        }
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
