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
    // Handle employer registration
    $companyName = $_POST['companyName'] ?? '';
    $industry = $_POST['industry'] ?? '';
    $contactInfo = $_POST['contactInfo'] ?? '';

    // Perform validation as needed
    if (!empty($companyName) && !empty($industry) && !empty($contactInfo)) {
        // Prepare and bind the INSERT statement
        $stmt = $conn->prepare("INSERT INTO employers (UserID, CompanyName, Industry, ContactInfo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $_SESSION['UserID'], $companyName, $industry, $contactInfo);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            // Redirect to employer profile upon successful registration
            header("Location: employer_profile.php");
            exit(); // Terminate script execution after redirect
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
    <title>Employer Registration</title>
    <!-- Add your CSS styles here -->
    <!-- Your CSS styles -->
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <div class='text'>
                <h3>Employer Registration</h3>
                <p>Join thousands of employers finding talented candidates.</p>
                <p>Sign up now to get started!</p>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <input placeholder="Company Name" type="text" id="companyName" name="companyName" required>
                </div>
                <div class="form-group">
                    <input placeholder="Industry" type="text" id="industry" name="industry" required>
                </div>
                <div class="form-group">
                    <input placeholder="Contact Info" type="text" id="contactInfo" name="contactInfo" required>
                </div>
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
