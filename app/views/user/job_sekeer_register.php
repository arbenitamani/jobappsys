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

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch job seeker data from the database
$userID = $_SESSION['UserID'];
$sql = "SELECT u.*, j.* FROM users u LEFT JOIN jobseekers j ON u.UserID = j.UserID WHERE u.UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$jobSeekerData = $result->fetch_assoc();

// Close statement
$stmt->close();

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Profile</title>
    <!-- Add your CSS styles here -->
    <!-- Your CSS styles -->
</head>
<body>
    <div class="profile-container">
        <div class="profile-left">
            <div class='text'>
                <h3>Welcome, <?php echo $jobSeekerData['UserName']; ?></h3>
                <p>Your Email: <?php echo $jobSeekerData['Email']; ?></p>
                <p>Your Phone: <?php echo $jobSeekerData['Phone']; ?></p>
                <!-- Display other job seeker data as needed -->
                <p>Your First Name: <?php echo $jobSeekerData['FirstName']; ?></p>
                <p>Your Last Name: <?php echo $jobSeekerData['LastName']; ?></p>
            </div>
            <!-- Add more profile information here -->
        </div>
    </div>
</body>
</html>
