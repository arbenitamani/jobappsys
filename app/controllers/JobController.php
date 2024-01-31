
<?php 
session_start();

// Include necessary files
require_once '../../models/config/database.php';
require_once '../../models/JobSeeker.php';

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle job seeker registration
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $phone = $_POST['phone'] ?? '';

    // Perform validation as needed
    if (!empty($firstName) && !empty($lastName) && !empty($phone)) {

        // Check if the user ID is set in the session
        if (isset($_SESSION['UserID'])) {
            // User ID is set, proceed with the job seeker registration

            // Check if the user is already registered
            $checkStmt = $conn->prepare("SELECT UserID FROM users WHERE UserID = ?");
            $checkStmt->bind_param("i", $_SESSION['UserID']); // Assuming UserID is an integer
            $checkStmt->execute();
            $checkStmt->store_result();

            // Rest of the code for checking and registering job seeker
            if ($checkStmt->num_rows > 0) {
                // Fetch user ID and proceed to register job seeker
                $checkStmt->bind_result($userID);
                $checkStmt->fetch();

                // User already exists, proceed to register job seeker
                $jobSeekerModel = new JobSeeker($conn);
                $errorMessage = $jobSeekerModel->registerJobSeeker($firstName, $lastName, $phone, $userID);

                if ($errorMessage === true) {
                    // Registration successful, perform additional actions if needed
                    $_SESSION['UserID'] = $userID; // Use the existing user ID
                    header("Location: ../../views/user/job_seeker_profile.php");
                    exit();
                } else {
                    // Registration failed, redirect with error message
                    header("Location: job_seeker_registration.php?error=" . urlencode($errorMessage));
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
        header("Location: job_seeker_registration.php?error=" . urlencode($errorMessage));
        exit();
    }
}
?>
