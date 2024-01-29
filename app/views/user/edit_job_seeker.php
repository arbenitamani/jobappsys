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

$sql = "SELECT u.UserID, u.UserName, u.Email, js.FirstName, js.LastName, js.Phone
        FROM users u
        LEFT JOIN jobseekers js ON u.UserID = js.UserID
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
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
   
   
    $email = $_POST['email'];
    $userName = $_POST['userName'];

    // Example: Update the profile details in the database
// Example: Update the profile details in the database
$updateSql = "UPDATE jobseekers SET 
                FirstName = '$firstName', 
                LastName = '$lastName', 
                Phone = '$phone' 
              WHERE UserID = $userID";


if ($conn->query($updateSql) === TRUE) {
    // Redirect back to the profile page after successful update
    header("Location: job_seeker_profile.php");
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
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" value="<?php echo isset($userData['FirstName']) ? $userData['FirstName'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" value="<?php echo isset($userData['LastName']) ? $userData['LastName'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" value="<?php echo isset($userData['Phone']) ? $userData['Phone'] : ''; ?>" required>
                </div>
              
               

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

</body>

</html>
