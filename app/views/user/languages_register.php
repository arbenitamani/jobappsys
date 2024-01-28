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
    // Handle language registration
    $languageName = $_POST['languageName'] ?? '';
    $proficiencyLevel = $_POST['proficiencyLevel'] ?? '';
    $certification = $_POST['certification'] ?? '';

    // Perform validation as needed
    if (!empty($languageName) && !empty($proficiencyLevel)) {
        // Prepare and bind the INSERT statement
        $stmt = $conn->prepare("INSERT INTO languages (UserID, LanguageName, ProficiencyLevel, Certification) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $_SESSION['UserID'], $languageName, $proficiencyLevel, $certification);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            $successMessage = "Language registered successfully";
            header("Location: job_seeker_profile.php");
        } else {
            $errorMessage = "Error: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        $errorMessage = "Language name and proficiency level are required fields";
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
    <title>Languages Registration</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Your CSS styles */
        /* Add your CSS styles here */
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

        .register-left input, .register-left select {
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

        .register-left input:focus, .register-left select:focus {
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
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <div class='text'>
                <h3>Languages Registration</h3>
                <p>Enter your language details.</p>
                <p>Sign up now to get started!</p>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <input placeholder="Language Name" type="text" id="languageName" name="languageName" required>
                </div>
                <div class="form-group">
                    <select id="proficiencyLevel" name="proficiencyLevel" required>
                        <option value="" disabled selected>Proficiency Level</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                        <option value="Native">Native</option>
                    </select>
                </div>
                <div class="form-group">
                    <input placeholder="Certification (optional)" type="text" id="certification" name="certification">
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
