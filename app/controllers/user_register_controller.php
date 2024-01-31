<?php
session_start();

require_once '../../models/config/database.php';
require_once '../../models/RegistrationModel.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle user registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $registrationModel = new RegistrationModel($conn);
    $errorMessage = $registrationModel->registerUser($username, $email, $password);

    if ($errorMessage === true) {
        // Registration successful, perform additional actions if needed
        $_SESSION['UserID'] = $conn->insert_id; // Update this line to get the last inserted ID

        // Redirect to user profile or another page upon successful registration
        header("Location: ../../views/user/choose_profile.php");
        exit(); // Terminate script execution after redirect
    } else {
        // Registration failed, redirect with error message
        header("Location: ../view/user_registration.php?error=" . urlencode($errorMessage));
        exit();
    }
}
?>
