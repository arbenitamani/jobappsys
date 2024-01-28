<?php
session_start();
$errorMessage = '';

// Check if the user ID is set in the session
if (!isset($_SESSION['UserID'])) {
    // Redirect to the job seeker registration page if the user ID is not set
    header("Location: job_seeker_register.php");
    exit(); // Terminate the script after redirection
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobappdb";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data and sanitize inputs
    $institutionName = mysqli_real_escape_string($conn, $_POST['institution_name']);
    $degree = mysqli_real_escape_string($conn, $_POST['degree']);
    $fieldOfStudy = mysqli_real_escape_string($conn, $_POST['field_of_study']);
    $graduationDate = mysqli_real_escape_string($conn, $_POST['graduation_date']);
    $userID = $_SESSION['UserID']; // Retrieve user ID from session

    // Prepare SQL statement to insert data into the education table
    $sql = "INSERT INTO education (UserID, InstitutionName, Degree, FieldOfStudy, GraduationDate) 
            VALUES ('$userID', '$institutionName', '$degree', '$fieldOfStudy', '$graduationDate')";

    if ($conn->query($sql) === TRUE) {
        $successMessage = "New record created successfully";
        header("Location: job_experience_register.php");
    } else {
        $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Registration</title>
    <!-- Add your CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9af12;
            margin: 0;
            padding: 0;
        }
        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .register-form h3 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        .register-form p {
            margin: 5px 0;
            color: #666;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input {
            width: 100%;
            height: 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0 10px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .form-group input:focus {
            outline: none;
            border-color: #218cff;
            box-shadow: 0 0 5px rgba(33, 140, 255, 0.5);
        }
        button[type="submit"] {
            width: 100%;
            height: 40px;
            border: none;
            border-radius: 5px;
            background-color: #218cff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .success-message {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
        /* Your CSS styles */
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <div class='text'>
                <h3>Education Registration</h3>
                <p>Enter your educational details.</p>
                <p>Sign up now to get started!</p>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <input placeholder="Institution Name" type="text" id="institution_name" name="institution_name" required>
                </div>
                <div class="form-group">
                    <input placeholder="Degree" type="text" id="degree" name="degree" required>
                </div>
                <div class="form-group">
                    <input placeholder="Field of Study" type="text" id="field_of_study" name="field_of_study" required>
                </div>
                <div class="form-group">
                    <input placeholder="Graduation Date" type="date" id="graduation_date" name="graduation_date" required>
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
