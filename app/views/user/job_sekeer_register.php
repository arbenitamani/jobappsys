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