<?php
session_start();

// Include your database connection and any other necessary includes

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Your existing database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobappdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data from the database
$userID = $_SESSION['UserID'];

$sql = "SELECT u.UserID, u.UserName, u.Email, e.ContactInfo, e.CompanyName, e.Industry
        FROM users u
        LEFT JOIN employers e ON u.UserID = e.UserID
        WHERE u.UserID = $userID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    $userData = array();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process form submission and update the profile in the database
    $contactInfo = $_POST['contactInfo'];
    $companyName = $_POST['companyName'];
    $industry = $_POST['industry'];
    $email = $_POST['email'];
    $userName = $_POST['userName'];

    // Example: Update the profile details in the database
    $updateSql = "UPDATE employers SET 
                    ContactInfo = '$contactInfo', 
                    CompanyName = '$companyName', 
                    Industry = '$industry' 
                  WHERE UserID = $userID";

    $updateUserSql = "UPDATE users SET 
                        Email = '$email', 
                        UserName = '$userName' 
                      WHERE UserID = $userID";

    if ($conn->query($updateSql) === TRUE && $conn->query($updateUserSql) === TRUE) {
        // Redirect back to the profile page after successful update
        header("Location: employer_profile.php");
        exit();
    } else {
        $errorMessage = "Error updating profile: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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

        /* Add your additional CSS styles for the editprofile.php page */
        .edit-profile-form {
            width: 400px;
            margin: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: orange;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>


    <div class="profile-container">
        <!-- Your edit profile form -->
        <div class="edit-profile-form">
            <h2>Edit Profile</h2>
            <?php if(isset($errorMessage)): ?>
                <p class="error-message"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- Include form fields for editing the profile -->
                <div class="form-group">
                    <label for="userName">Username:</label>
                    <input type="text" name="userName" value="<?php echo isset($userData['UserName']) ? $userData['UserName'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?php echo isset($userData['Email']) ? $userData['Email'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="contactInfo">Contact Info:</label>
                    <input type="text" name="contactInfo" value="<?php echo isset($userData['ContactInfo']) ? $userData['ContactInfo'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="companyName">Company Name:</label>
                    <input type="text" name="companyName" value="<?php echo isset($userData['CompanyName']) ? $userData['CompanyName'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="industry">Industry:</label>
                    <input type="text" name="industry" value="<?php echo isset($userData['Industry']) ? $userData['Industry'] : ''; ?>" required>
                </div>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

</body>
</html>
