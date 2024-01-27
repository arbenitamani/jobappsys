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
   // $categoryID = $_POST['categoryID'] ?? '';

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
    <!-- Your CSS styles -->
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
                <div class="form-group">
                    <label for="employerID">Employer ID:</label>
                    <input type="text" name="employerID" required>
                </div>
                <!-- <div class="form-group">
                    <label for="categoryID">Category ID:</label>
                    <input type="text" name="categoryID" required>
                </div> -->
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
