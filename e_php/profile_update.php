<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo json_encode(['message' => 'You must be logged in to update your profile.']);
    exit();
}

// Get the new username and other details from the AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables
    $username = isset($_POST['user']) ? $_POST['user'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    // Check if ID and email are provided
    if ($email) {
        $sql="UPDATE `userdata` SET `username`='$username',`password`='$password' WHERE `email`='$email' ";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['username'] = $username; 
            echo  $username;
        } else {
            echo json_encode(["message" => "Error updating record: " . mysqli_error($conn)]);
        }
    }else {
        echo "ID is missing";
    }
}
// Close the database connection
// $conn->close();
?>