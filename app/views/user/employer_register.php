<?php
require_once '../../controllers/EmployerController.php';

// Define these variables based on your logic in EmployerController.php
$successMessage = "Registration successful!";
$errorMessage = "There was an error in registration.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Registration</title>
    <!-- Add your CSS styles here -->
    <!-- Your CSS styles -->
    <style>
        .register-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: rgba(249, 175, 18, 1);
    text-align: center;
}

.register-left {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: rgb(255, 255, 255);
    height: 100%;
    width: 70%;
}

.register-left .text {
    text-align: center;
    font-family: 'Oswald', sans-serif;
    font-size: 30px;
    margin-bottom: 3%;
    color: rgb(81, 81, 81);
}

.register-left form {
    width: 80%;
}

.register-left label {
    color: #333;
    font-size: 18px;
    font-family: 'Oswald', sans-serif;
}

.register-left input {
    background-color: #fff;
    border: 1px solid #ccc;
    height: 40px;
    width: 100%;
    border-radius: 15px;
    font-size: 16px;
    padding-left: 10px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    outline: none;
    margin-bottom: 2%;
}

.register-left input:focus {
    border-color: rgb(156, 158, 255);
    box-shadow: 0 0 5px rgba(45, 133, 234, 0.5);
    color: lightgray;
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
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <div class='text'>
                <h3>Employer Registration</h3>
                <p>Join thousands of employers finding talented candidates.</p>
                <p>Sign up now to get started!</p>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <input placeholder="Company Name" type="text" id="CompanyName" name="CompanyName" required>
                </div>
                <div class="form-group">
                    <input placeholder="Industry" type="text" id="Industry" name="Industry" required>
                </div>
                <div class="form-group">
                    <input placeholder="Contact Info" type="text" id="ContactInfo" name="ContactInfo" required>
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
