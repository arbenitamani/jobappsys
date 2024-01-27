<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
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

// Fetch user data from the database
$userID = $_SESSION['UserID'];
$sql = "SELECT * FROM jobseekers WHERE UserID = $userID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User data found
    $userData = $result->fetch_assoc();
} else {
    // No user data found
    $userData = array(); // Empty array
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Add your CSS styles here -->
</head>
<body>
    <!-- Include the job seeker navbar -->
    <?php include './job_sekeer_navbar.php'; ?>

    <h1>User Profile</h1>
    <p>Welcome, <?php echo isset($userData['FirstName']) ? $userData['FirstName'] : 'User'; ?></p>
    <p>First Name: <?php echo isset($userData['FirstName']) ? $userData['FirstName'] : 'N/A'; ?></p>
    <p>Last Name: <?php echo isset($userData['LastName']) ? $userData['LastName'] : 'N/A'; ?></p>
    <p>Phone: <?php echo isset($userData['Phone']) ? $userData['Phone'] : 'N/A'; ?></p>
    <!-- Add more user data as needed -->

    <!-- Add your HTML content and styling here -->
</body>
</html>
