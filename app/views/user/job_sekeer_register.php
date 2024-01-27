<?php
session_start();
$errorMessage = '';

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobappdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle job seeker registration
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $phone = $_POST['phone'] ?? '';
    // Handle resume file upload if needed

    // Perform validation as needed
    if (!empty($firstName) && !empty($lastName) && !empty($phone)) {
        // Prepare and bind the INSERT statement
        $stmt = $conn->prepare("INSERT INTO jobseekers (UserID, FirstName, LastName, Phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $_SESSION['UserID'], $firstName, $lastName, $phone);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            $successMessage = "Job Seeker registered successfully";
            // Redirect to choose_profile.php
            header("Location: job_seeker_profile.php");
            exit(); // Terminate the script after redirection
        } else {
            $errorMessage = "Error: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        $errorMessage = "All fields are required";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Registration</title>
    <!-- Add your CSS styles here -->
    <!-- Your CSS styles -->
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <div class='text'>
                <h3>Job Seeker Registration</h3>
                <p>Join thousands of job seekers finding their dream jobs.</p>
                <p>Sign up now to get started!</p>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <input placeholder="First Name" type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <input placeholder="Last Name" type="text" id="lastName" name="lastName" required>
                </div>
                <div class="form-group">
                    <input placeholder="Phone" type="text" id="phone" name="phone" required>
                </div>
                <!-- Resume upload field if needed -->
                <!-- <div class="form-group">
                    <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx">
                </div> -->
                <button type="submit">Register</button>
                <?php if(isset($successMessage)): ?>
                    <p><?php echo $successMessage; ?></p>
                <?php endif; ?>
                <?php if(!empty($errorMessage)): ?>
                    <p class="error-message"><?php echo $errorMessage; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>
