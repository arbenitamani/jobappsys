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
    <style>
        .register-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: rgba(249, 175, 18, 1);
    text-align: center;
}

.register-left {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: rgb(255, 255, 255);
    height: 100%;
    width: 70%;
}

.register-left .text {
    text-align: center;
    font-family: 'Oswald', sans-serif;
    font-size: 30px;
    margin-bottom: 3%;
    color: rgb(81, 81, 81);
}

.register-left form {
    width: 80%;
}

.register-left label {
    color: #333;
    font-size: 18px;
    font-family: 'Oswald', sans-serif;
}

.register-left input {
    background-color: #fff;
    border: 1px solid #ccc;
    height: 40px;
    width: 100%;
    border-radius: 15px;
    font-size: 16px;
    padding-left: 10px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    outline: none;
    margin-bottom: 2%;
}

.register-left input:focus {
    border-color: rgb(156, 158, 255);
    box-shadow: 0 0 5px rgba(45, 133, 234, 0.5);
    color: lightgray;
}

button {
    width: 90%; /* Maintain width */
    height: 40px; /* Maintain height */
    font-size: 16px; /* Decrease font size slightly */
    cursor: pointer;
    color: #fff; /* White text */
    border-radius: 10px;
    border: none;
    background-color: #218cff; /* Blue button color */
    transition: background-color 0.3s ease; /* Smooth transition */
    margin-top: 15px; /* Add space between button and inputs */
    margin-bottom: 10px;
    margin-left: 5%;
    
}

button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}
    </style>
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
