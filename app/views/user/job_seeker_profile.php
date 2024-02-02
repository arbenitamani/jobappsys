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
$sql_user = "SELECT * FROM jobseekers WHERE UserID = $userID";
$result_user = $conn->query($sql_user);

if ($result_user->num_rows > 0) {
    // User data found
    $userData = $result_user->fetch_assoc();
} else {
    // No user data found
    $userData = array(); // Empty array
    
}





$userID = $_SESSION['UserID'];

$sql = "SELECT u.UserID, u.UserName, u.Email, js.FirstName, js.LastName, js.Phone
        FROM users u
        LEFT JOIN jobseekers js ON u.UserID = js.UserID
        WHERE u.UserID = $userID";


// Fetch education data
$sql_education = "SELECT * FROM education WHERE UserID = $userID";
$result_education = $conn->query($sql_education);

// Fetch work experience data
$sql_experience = "SELECT * FROM workexperience WHERE UserID = $userID";
$result_experience = $conn->query($sql_experience);

// Fetch language data
$sql_languages = "SELECT * FROM languages WHERE UserID = $userID";
$result_languages = $conn->query($sql_languages);

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
            align-items: flex-start;
            flex-direction: column;
        }

        .profile-left {
            
            text-align: center;
        }

        .profile-left img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }

        .profile-left h3 {
            color: #FFA500;
            margin-top: 20px;
        }

        .profile-left p {
            font-size: 16px;
        }

        .profile-right {
            width: 600px;
            background-color: #FFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-right h3 {
            color: #FFA500;
            margin-top: 0;
        }

        .profile-right p {
            font-size: 16px;
        }

        .profile-right hr {
            border: 1px solid #ddd;
            margin: 15px 0;
        }
        .all{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 100px;
            margin-left: 300px;
            margin-top: 50px;
           
        }
    </style>
</head>
<body>
    <div class="profile-container">
    
    <?php

include '../../views/user/job_sekeer_navbar.php';
?>

    <div class="all">
         <div class="profile-left">
            <img src="../../../images/uprof.png" alt="">
            <h3>Welcome, <?php echo isset($userData['FirstName']) ? $userData['FirstName'] : 'User'; ?></h3>
            <p><strong>First Name:</strong> <?php echo isset($userData['FirstName']) ? $userData['FirstName'] : 'N/A'; ?></p>
            <p><strong>Last Name:</strong> <?php echo isset($userData['LastName']) ? $userData['LastName'] : 'N/A'; ?></p>
            <p><strong>Phone:</strong> <?php echo isset($userData['Phone']) ? $userData['Phone'] : 'N/A'; ?></p>
        </div>
        <div class="profile-right">
            <div class="text">
                <h3>Education</h3>
                <?php if ($result_education->num_rows > 0) {
                    while ($row = $result_education->fetch_assoc()) {
                        echo "<p><strong>Institution Name:</strong> " . $row['InstitutionName'] . "</p>";
                        echo "<p><strong>Degree:</strong> " . $row['Degree'] . "</p>";
                        echo "<p><strong>Field of Study:</strong> " . $row['FieldOfStudy'] . "</p>";
                        echo "<p><strong>Graduation Date:</strong> " . $row['GraduationDate'] . "</p>";
                    }
                } else {
                    echo "<p>No education data available.</p>";
                } ?>
                <hr>
                <h3>Experience</h3>
                <?php if ($result_experience->num_rows > 0) {
                    while ($row = $result_experience->fetch_assoc()) {
                        echo "<p><strong>Company Name:</strong> " . $row['CompanyName'] . "</p>";
                        echo "<p><strong>Position:</strong> " . $row['Position'] . "</p>";
                        echo "<p><strong>Start Date:</strong> " . $row['StartDate'] . "</p>";
                        echo "<p><strong>End Date:</strong> " . $row['EndDate'] . "</p>";
                        echo "<p><strong>Description:</strong> " . $row['Description'] . "</p>";
                    }
                } else {
                    echo "<p>No work experience data available.</p>";
                } ?>
                <hr>
                <h3>Languages</h3>
                <?php if ($result_languages->num_rows > 0) {
                    while ($row = $result_languages->fetch_assoc()) {
                        echo "<p><strong>Language:</strong> " . $row['LanguageName'] . "</p>";
                        echo "<p><strong>Proficiency Level:</strong> " . $row['ProficiencyLevel'] . "</p>";
                        echo "<p><strong>Certification:</strong> " . $row['Certification'] . "</p>";
                    }
                } else {
                    echo "<p>No language data available.</p>";
                } ?>
            </div>
            <a href="edit_job_seeker.php" class="edit-profile-button">Edit Profile</a>
        </div>
    </div>
       
    </div>

</body>
</html>
