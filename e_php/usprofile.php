<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Fetch user data from the database
$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT username, email FROM userdata WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();
$conn->close();
?>