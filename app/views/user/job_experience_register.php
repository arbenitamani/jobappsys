<?php
session_start();
$errorMessage = '';

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    // Redirect the user to the login page or handle the authentication process
    header("Location: login.php");
    exit(); // Terminate the script after redirection
}

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
    // Handle job experience registration
    $companyName = $_POST['companyName'] ?? '';
    $position = $_POST['position'] ?? '';
    $startDate = $_POST['startDate'] ?? '';
    $endDate = $_POST['endDate'] ?? '';
    $description = $_POST['description'] ?? '';

    // Perform validation as needed
    if (!empty($companyName) && !empty($position) && !empty($startDate)) {
        // Prepare and bind the INSERT statement
        $stmt = $conn->prepare("INSERT INTO workexperience (UserID, CompanyName, Position, StartDate, EndDate, Description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $_SESSION['UserID'], $companyName, $position, $startDate, $endDate, $description);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            $successMessage = "Job Experience registered successfully";
            // Redirect to some page after registration
            header("Location: languages_register.php");
            // exit(); // Terminate the script after redirection
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
    <title>Job Experience Registration</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Your CSS styles */
        /* Add your CSS styles here */
        /* Your CSS styles */
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

        .register-left input,
        .register-left textarea {
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

        .register-left input:focus,
        .register-left textarea:focus {
            border-color: rgb(156, 158, 255);
            box-shadow: 0 0 5px rgba(45, 133, 234, 0.5);
            color: lightgray;
        }

        button {
            width: 90%;
            height: 40px;
            font-size: 16px;
            cursor: pointer;
            color: #fff;
            border-radius: 10px;
            border: none;
            background-color: #218cff;
            transition: background-color 0.3s ease;
            margin-top: 15px;
            margin-bottom: 10px;
            margin-left: 5%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <div class='text'>
                <h3>Job Experience Registration</h3>
                <p>Enter your work experience details.</p>
                <p>Sign up now to get started!</p>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <input placeholder="Company Name" type="text" id="companyName" name="companyName" required>
                </div>
                <div class="form-group">
                    <input placeholder="Position" type="text" id="position" name="position" required>
                </div>
                <div class="form-group">
                    <input placeholder="Start Date" type="date" id="startDate" name="startDate" required>
                </div>
                <div class="form-group">
                    <input placeholder="End Date" type="date" id="endDate" name="endDate">
                </div>
                <div class="form-group">
                    <textarea placeholder="Description" id="description" name="description" rows="4" required></textarea>
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
