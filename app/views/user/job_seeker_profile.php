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
    <link rel="stylesheet" href="userprofile.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .profile-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }

        .profile-left {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 400px;
            height: 500px;
            background-color: lightgrey;
            box-shadow: 0 0 10px rgba(203, 246, 260, 3.7);            
            border-radius: 10px;
           padding: 20px;
        }

        .profile-left h3 {
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 60px;
            color: rgb(45, 118, 164);
            text-transform: uppercase;
        }

        .profile-left p {
            font-size: 25px;
            margin-bottom: 5px;
            color:black;
        }
        .profile-left p strong{
            color:rgb(45, 118, 164);
            font-size: 18px;
        }

        .profile-right {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            background-image: url('../../../images/ub.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-right">
             <div class="profile-left">
            
            <div class="text">
                <h3>Welcome, <?php echo isset($userData['FirstName']) ? $userData['FirstName'] : 'User'; ?></h3>
    <p><strong>First Name:</strong>  <?php echo isset($userData['FirstName']) ? $userData['FirstName'] : 'N/A'; ?></p>
    <p><strong> Name:</strong> <?php echo isset($userData['LastName']) ? $userData['LastName'] : 'N/A'; ?></p>
    <p><strong>Phone: </strong> <?php echo isset($userData['Phone']) ? $userData['Phone'] : 'N/A'; ?></p>
    <!-- Add more user data as needed -->
        </div>
        </div>
       
    </div>
</body>
</html>
