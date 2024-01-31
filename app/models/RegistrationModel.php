<?php

class RegistrationModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function registerUser($username, $email, $password)
    {
        $errorMessage = '';

        // Perform validation as needed
        if (!empty($username) && !empty($email) && !empty($password)) {
            // Check if the email already exists
            $checkStmt = $this->conn->prepare("SELECT UserID FROM Users WHERE Email = ?");
            $checkStmt->bind_param("s", $email);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows > 0) {
                // Email already exists, show an error message
                $errorMessage = "Error: This email is already registered.";
            } else {
                // Password validation
                if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[^a-zA-Z0-9]/", $password)) {
                    $errorMessage = "Error: Password should be at least 8 characters long, contain at least one uppercase letter, and contain at least one special character.";
                } else {
                    // Email does not exist and password is valid, proceed with user registration
                    $checkStmt->close();

                    // Prepare and bind the INSERT statement
                    $insertStmt = $this->conn->prepare("INSERT INTO Users (UserName, Email, Password) VALUES (?, ?, ?)");
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $insertStmt->bind_param("sss", $username, $email, $hashedPassword);

                    // Execute the statement
                    if ($insertStmt->execute() === TRUE) {
                        $_SESSION['UserID'] = $insertStmt->insert_id; // Store the inserted user ID in session
                        $insertStmt->close();
                        return true; // Registration success
                    } else {
                        $errorMessage = "Error: " . $this->conn->error;
                    }

                    // Close statement
                    $insertStmt->close();
                }
            }
        } else {
            $errorMessage = "All fields are required";
        }

        return $errorMessage;
    }
}
?>
