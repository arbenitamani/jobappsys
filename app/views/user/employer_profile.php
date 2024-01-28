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

// Join the users and employers tables on UserID
$sql = "SELECT u.UserID, u.UserName, u.Email, e.ContactInfo, e.CompanyName, e.Industry
        FROM users u
        LEFT JOIN employers e ON u.UserID = e.UserID
        WHERE u.UserID = $userID";

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
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
            gap: 200px;
        }

        .profile-left img{
            width: 200px;
            height: 200px;
            margin-top: -900px;
        }
.profile-left h3{
    font-size: 28px;
          color: orange;
          margin-top: 50px;
}
.profile-left p{
    font-size: 18px;
          
}
.profile-left strong{
            color: orange;
            font-size: 25px;
        }
        .profile-right h3{
          font-size: 28px;
          color: orange;
        }

        .profile-right p{
            font-size: 18px;
            width: 900px;
        }

        .profile-right strong{
            color: orange;
            font-size: 25px;
        }
        .profile-right hr{
            width: auto;
            height: 2px solid black;
        }
     
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-left"> 
            <img src="../../../images/uprof.png" alt=""> 
        </div>
        <div class="profile-right">
            <div class="text"> 
                <h3>Welcome, <?php echo isset($userData['UserName']) ? $userData['UserName'] : 'User'; ?></h3>
                <hr>
                <p><strong>Email:</strong> <?php echo isset($userData['Email']) ? $userData['Email'] : 'N/A'; ?></p>
                <hr>
                <h3>User Information</h3>
                <p><strong>Contact Info:</strong> <?php echo isset($userData['ContactInfo']) ? $userData['ContactInfo'] : 'N/A'; ?></p>
                <p><strong>Company Name:</strong> <?php echo isset($userData['CompanyName']) ? $userData['CompanyName'] : 'N/A'; ?></p>
                <p><strong>Industry:</strong> <?php echo isset($userData['Industry']) ? $userData['Industry'] : 'N/A'; ?></p>
                <hr>
                <a href="createjobpost.php?employerID=<?php echo isset($userData['UserID']) ? $userData['UserID'] : ''; ?>" class="create-jobpost-button">Create Job Post</a>
            </div>
        </div>
    </div>
</body>
</html>
