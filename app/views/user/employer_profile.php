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
$sql = "SELECT u.*, e.* FROM users u  INNER JOIN employers e ON u.UserID = e.UserID WHERE u.UserID = ?";
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
            font-size: 15px;
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
            <!-- Add your background image here -->
             <div class="profile-left">
            <div class='text'>
                <h3>Welcome, <?php echo $userData['UserName']; ?></h3>
                <p><strong>Your Email:</strong> <br><br> <?php echo $userData['Email']; ?></p>
                <p><strong> Company Name:</strong> <br><br><?php echo $userData['CompanyName']; ?></p>
                <p><strong> Industry:</strong> <br><br><?php echo $userData['Industry']; ?></p>
                <p><strong> Contact Info:</strong><br><br> <?php echo $userData['ContactInfo']; ?></p>
            </div>
            <!-- Add more profile information here -->
        </div>
        </div>
    </div>
</body>
</html>
