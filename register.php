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
    // Handle user registration
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Perform validation as needed
    if (!empty($username) && !empty($email) && !empty($password)) {
        // Prepare and bind the INSERT statement
        $stmt = $conn->prepare("INSERT INTO Users (UserName, Email, Password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            $successMessage = "User registered successfully";
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
    <title>User Registration</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Add your CSS styles here */
        .register-container {
            /* Your styling */
        }

        .register-left {
            /* Your styling */
        }

        .register-right {
            /* Your styling */
        }

        /* Add more styles as needed */
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <div class='text'>
                <h3>WorkWise</h3>
                <p>Join thousands of professionals finding exciting job opportunities.</p>
                <p>Sign up now to get started!</p>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <input placeholder="username" type="text" id="UserName" name="username" required>
                </div>
                <div class="form-group">
                    <input placeholder="e-mail" type="email" id="Email" name="email" required>
                </div>
                <div class="form-group">
                    <input placeholder="password" type="password" id="Password" name="password" required>
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
