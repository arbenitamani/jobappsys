<?php
session_start();
$errorMessage = '';
$successMessage = '';

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
    // Handle job post creation
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $qualifications = $_POST['qualifications'] ?? '';
    $location = $_POST['location'] ?? '';
    $salary = $_POST['salary'] ?? '';
    $employerID = $_POST['employerID'] ?? '';
    header("Location: ../job/job_list.php");
    // Check if the EmployerID exists in the employers table
    $checkExistenceStmt = $conn->prepare("SELECT UserID FROM employers WHERE UserID = ?");
    $checkExistenceStmt->bind_param("i", $employerID);
    $checkExistenceStmt->execute();
    $checkExistenceStmt->store_result();

    if ($checkExistenceStmt->num_rows == 0) {
        // EmployerID does not exist, handle this case
        $errorMessage = "Error: Employer with ID $employerID does not exist.";
    } else {
        // EmployerID exists, proceed with job post insertion
        $stmt = $conn->prepare("INSERT INTO jobposts (Title, Description, Qualifications, Location, Salary, EmployerID) VALUES (?, ?, ?, ?, ?, ?)");
        // Corrected bind_param
        $stmt->bind_param("ssssdd", $title, $description, $qualifications, $location, $salary, $employerID);

        if ($stmt->execute() === TRUE) {
            $successMessage = "Job post created successfully";
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close the checkExistenceStmt
    $checkExistenceStmt->close();
}

// Retrieve employerID from URL parameter or set it to an empty string if not present
$employerIDFromURL = isset($_GET['employerID']) ? $_GET['employerID'] : '';

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Job Post</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Your CSS styles */
        .create-jobpost-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: rgba(249, 175, 18, 1);
            text-align: center;
        }

        .create-jobpost-left {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: rgb(255, 255, 255);
            height: 100%;
            width: 70%;
        }

        .create-jobpost-left .text {
            text-align: center;
            font-family: 'Oswald', sans-serif;
            font-size: 30px;
            margin-bottom: 3%;
            color: rgb(81, 81, 81);
        }

        .create-jobpost-left form {
            width: 80%;
        }

        .create-jobpost-left label {
            color: #333;
            font-size: 18px;
            font-family: 'Oswald', sans-serif;
        }

        .create-jobpost-left input, .create-jobpost-left textarea {
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

        .create-jobpost-left input:focus, .create-jobpost-left textarea:focus {
            border-color: rgb(156, 158, 255);
            box-shadow: 0 0 5px rgba(45, 133, 234, 0.5);
            color: lightgray;
        }

        .create-jobpost-container button {
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

        .create-jobpost-container button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="create-jobpost-container">
        <div class="create-jobpost-left">
            <div class='text'>
                <h3>Create Job Post</h3>
                <p>Describe the details of the job you're posting.</p>
                <p>Get started now!</p>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- Include form fields for creating a new job post -->
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="qualifications">Qualifications:</label>
                    <textarea name="qualifications" required></textarea>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" name="location" required>
                </div>
                <div class="form-group">
                    <label for="salary">Salary:</label>
                    <input type="text" name="salary" required>
                </div>
                <!-- Pre-fill employerID from the URL parameter -->
                <input type="hidden" name="employerID" value="<?php echo $employerIDFromURL; ?>">
                <button type="submit">Create Job Post</button>
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
