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
     
        /* Add styles for the navigation bar */
        nav {
            background-color: orange;
            padding: 10px 20px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        nav ul li {
            float: right;
        }

        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav ul li a:hover {
            color: black;
        }

.edit-profile-button {
    display: inline-block;
    background-color: #3498db;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.edit-profile-button:hover {
    background-color: #2980b9;
}

    </style>
</head>
<body>
<nav>
        <ul>
            <li><a href="employer_profile.php">My Profile</a></li>
            <li><a href="createjobpost.php?employerID=<?php echo isset($userData['UserID']) ? $userData['UserID'] : ''; ?>" class="create-jobpost-button">Create Job Post</a></li>
            
            <li><a href="../../../index.php">Home</a></li>
        </ul>
    </nav>

    <div class="profile-container">
   
        <div class="profile-left"> 
            <img src="../images/uprof.png" alt=""> 
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
                
            </div>
            <a href="edit_employer.php" class="edit-profile-button">Edit Profile</a>

        </div>
    </div>
</body>
</html>
