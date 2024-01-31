<?php
session_start();

// Include necessary files
require_once '../../models/config/database.php';
require_once '../../models/EmployerModel.php';

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle employer registration
    $companyName = $_POST['CompanyName'] ?? '';
    $industry = $_POST['Industry'] ?? '';
    $contactInfo = $_POST['ContactInfo'] ?? '';

    // Perform validation as needed
    if (!empty($companyName) && !empty($industry) && !empty($contactInfo)) {

        // Check if the user ID is set in the session
        if (isset($_SESSION['UserID'])) {
            // User ID is set, proceed with the employer registration

            // Check if the user is already registered
            $checkStmt = $conn->prepare("SELECT UserID FROM users WHERE UserID = ?");
            $checkStmt->bind_param("i", $_SESSION['UserID']); // Assuming UserID is an integer
            $checkStmt->execute();
            $checkStmt->store_result();

            // Rest of the code for checking and registering employer
            if ($checkStmt->num_rows > 0) {
                // Fetch user ID and proceed to register employer
                $checkStmt->bind_result($userID);
                $checkStmt->fetch();

                // User already exists, proceed to register employer
                $employerModel = new Employer($conn);
                $errorMessage = $employerModel->registerEmployer($userID, $companyName, $industry, $contactInfo);

                if ($errorMessage === true) {
                    // Registration successful, perform additional actions if needed
                    $_SESSION['UserID'] = $userID; // Use the existing user ID
                    header("Location: ../../views/user/employer_profile.php");
                    exit();
                } else {
                    // Registration failed, redirect with error message
                    header("Location: employer_registration.php?error=" . urlencode($errorMessage));
                    exit();
                }
            } else {
                // User does not exist, handle the situation accordingly
                // You might want to redirect to a registration page for the user first
            }

            // Close the $checkStmt
            $checkStmt->close();
        } else {
            // User ID is not set in the session, handle the situation accordingly
            // Redirect to a registration page for the user
            header("Location: user_registration.php");
            exit();
        }
    } else {
        $errorMessage = "All fields are required"; // Validation failed
        header("Location: employer_registration.php?error=" . urlencode($errorMessage));
        exit();
    }
}
?>
