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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle user registration
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Perform validation as needed
    if (!empty($username) && !empty($email) && !empty($password)) {
        // Prepare and bind the INSERT statement
        $stmt = $conn->prepare("INSERT INTO Users (UserName, Email, Password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            $successMessage = "User registered successfully";
        } else {
            $errorMessage = "Error: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        $errorMessage = "All fields are required";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Add your CSS styles here */
        .register-container {
            display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100vh;
    background-color: rgba(249,175,18,255);

  text-align: center;
            /* Your styling */
        }

        .register-left {
            display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background-color:rgb(255, 255, 255) ;
        height: 100%;
         width: 70%;
       

         .text{
            text-align: center;
            font-family: 'Oswald', sans-serif;
            font-size: 30px;
            margin-bottom: 3%;
            color: rgb(81, 81, 81);
         }

      form{
        width: 80%;

      }

      

label {
    color: #333; /* Dark gray text */
    font-size: 18px; /* Maintain font size */
    font-family: 'Oswald', sans-serif;
   
}

input {
    background-color: #fff; /* White background color */
    border: 1px solid #ccc; /* Default gray border */
    height: 40px;
    width: 100%;
    border-radius: 15px;
    font-size: 16px;
    padding-left: 10px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
    outline: none;
    margin-bottom: 2%;

    &:focus {
        border-color: rgb(156, 158, 255); /* Coral border color on focus */
        box-shadow: 0 0 5px rgba(45, 133, 234, 0.5); /* Slight shadow on all sides */
        color: lightgray;
    }
}

button {
    width: 90%; /* Maintain width */
    height: 40px; /* Maintain height */
    font-size: 16px; /* Decrease font size slightly */
    cursor: pointer;
    color: #fff; /* White text */
    border-radius: 10px;
    border: none;
    background-color: #218cff; /* Blue button color */
    transition: background-color 0.3s ease; /* Smooth transition */
    margin-top: 15px; /* Add space between button and inputs */
    margin-bottom: 10px;
    margin-left: 5%;
    
}

button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

p {
   
    font-size: 14px; /* You can adjust the font size as needed */
    color: #333; /* Adjust the color as needed */
    margin-bottom: 10px; /* Add some margin at the bottom */
  }

a {
    color: #007bff; /* Blue link color */
    text-decoration: none;
    cursor: pointer;
    margin-top: 10px; /* Adjust margin */
    transition: color 0.3s ease; /* Smooth transition */
}

a:hover {
    color: #0056b3; /* Darker blue on hover */
}

    
            /* Your styling */
        }

      

        /* Add more styles as needed */
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <div class='text'>
                <h3>WorkWise</h3>
                <p>Join thousands of professionals finding exciting job opportunities.</p>
                <p>Sign up now to get started!</p>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <input placeholder="username" type="text" id="UserName" name="username" required>
                </div>
                <div class="form-group">
                    <input placeholder="e-mail" type="email" id="Email" name="email" required>
                </div>
                <div class="form-group">
                    <input placeholder="password" type="password" id="Password" name="password" required>
                </div>
                <button type="submit">Register</button>
                <?php if(isset($successMessage)): ?>
                    <p><?php echo $successMessage; ?></p>
                <?php endif; ?>
                <?php if(!empty($errorMessage)): ?>
                    <p class="error-message"><?php echo $errorMessage; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>
