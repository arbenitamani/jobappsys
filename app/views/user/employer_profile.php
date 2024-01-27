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

// Fetch user data from the database
$userID = $_SESSION['UserID'];
$sql = "SELECT u.*, e.* FROM users u LEFT JOIN employers e ON u.UserID = e.UserID WHERE u.UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

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
    <title>User Profile</title>
    <!-- Add your CSS styles here -->
    <!-- Your CSS styles -->
</head>
<body>
    <div class="profile-container">
        <div class="profile-left">
            <div class='text'>
                <h3>Welcome, <?php echo $userData['UserName']; ?></h3>
                <p>Your Email: <?php echo $userData['Email']; ?></p>
              
                <!-- Display other user data as needed -->
                <p>Your Company Name: <?php echo $userData['CompanyName']; ?></p>
                <p>Your Industry: <?php echo $userData['Industry']; ?></p>
                <p>Your Contact Info: <?php echo $userData['ContactInfo']; ?></p>
            </div>
            <!-- Add more profile information here -->
        </div>
    </div>
</body>
</html>
