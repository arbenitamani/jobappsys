<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobappdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Lidhja deshtoi" . $conn->connect_error);
}

// Initialize variables
$email = '';
$password = '';
$loginError = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from form submission
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ? AND Password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    // Store the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, handle login logic (e.g., set session variables)
        // Redirect or send a success response to the client
        echo json_encode(["success" => true, "message" => "Login successful"]);
        exit();
    } else {
        echo("Invalid email or password");
        $loginError = "Invalid email or password";
    }

    // Close prepared statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- Add your CSS styles here -->
    <style>
   .login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 98vh;
   }

    .login-left {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 50%;
        background-color: #f5f5f5; /* Subtle gray background */
        height: 100%;
    }

        .login-left img {
            max-width: 130%; /* Adjust image size */
            height: 100vh; /* Maintain aspect ratio */
          
        }
        .text-overlay {
            position: absolute; /* Position the overlay relative to the container */
            bottom: 20; /* Start from the bottom of the container */
            left: 40; /* Adjust as needed */
            width: 47%; /* Take the full width of the container */
            padding: 20px; /* Adjust padding as needed */
            color: rgb(255, 255, 255);
            text-align: center; /* Center the text */
            animation: slide-up 0.5s ease forwards; /* Apply the slide-up animation */
            opacity: 0; /* Initially hide the text */
         
        }
        
        @keyframes slide-up {
        
            from {
                transform: translateY(100%); /* Start from below the container */
                opacity: 0; /* Start with opacity 0 */
            }
            to {
                transform: translateY(0); /* Move to the top of the container */
                opacity: 1; /* Fade in */
            }
        }
        
 .h1 {
    margin-top: 0; /* Remove default margin */
    font-size: 50px; /* Adjust font size */
    font-weight: 900;
}

 .p {
    margin-bottom: 0; /* Remove default margin */
    font-size: 18px; /* Adjust font size */
    font-weight: 800;
}
    

    .login-right {
        width: 50%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        background-color: rgba(249,175,18,255);
    }

        .inner-container {
            background-color: #fff; /* White background color */
            border-radius: 6px; /* Border radius of 6px */
            padding: 20px; /* Padding for inner container */
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1); /* Add box shadow for depth */
            width: 80%; /* Adjust width as needed */
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
                width: 90%;
                border-radius: 25px;
                font-size: 16px;
                padding-left: 10px;
                transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
                outline: none;
            }

            
                &:focus {
                    border-color: rgb(156, 158, 255); /* Coral border color on focus */
                    box-shadow: 0 0 5px rgba(45, 133, 234, 0.5); /* Slight shadow on all sides */
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
                
            }

            button:hover {
                background-color: #0056b3; /* Darker blue on hover */
            }

            p {
               
                font-size: 14px; /* You can adjust the font size as needed */
                color: white; /* Adjust the color as needed */
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
            .welcome-text {
                font-size: 30px;
                font-family: 'Oswald', sans-serif;
                color: #333;
            }
        
            .instruction-text {
                font-size: 15px;
                color: #666;
                font-family: 'Oswald', sans-serif;
                padding-bottom: 5%;
            }
    

    </style>
</head>
<body>
    <div class='login-container'>
        <div class='login-left'>
            <div class="text-overlay">
                  <h1 class="h1">WorkWise</h1>
            <p class="p">"Connecting Talent with Opportunity"</p>
            </div>
          
            <img src="../../../images/job2.jpg" alt="Job Image">
        </div>
        <div class='login-right'>
            <div class='inner-container'>
                <p class="welcome-text">Welcome Back!</p>
                <?php if(isset($errorMessage)): ?>
                    <p class="error-message"><?php echo $errorMessage; ?></p>
                <?php endif; ?>
                <p class="instruction-text">Please enter your email and password to access your account</p>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div>
        <input placeholder='Enter your email' type="text" id="Email" name="Email" required>
    </div>
    <br />
    <div>
        <input placeholder='Enter your password' type="password" id="Password" name="Password" required>
    </div>
    <br />
    <div>
        <button type="submit">Login</button>
        <?php if (!empty($loginError)): ?>
            <p class="error-message"><?php echo "Invalid email or password"; ?></p>
        <?php endif; ?>
        <p>You don't have an account?</p>
        <a href="register.php">Register</a>
    </div>
</form>

            </div>
        </div>
    </div>
</body>
</html>
