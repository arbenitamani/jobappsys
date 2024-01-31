<?php
require_once 'User.php';

class JobSeeker {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registerJobSeeker($firstName, $lastName, $phone, $userID) {
        // Check if the user with the provided UserID exists in the users table
        $checkUserStmt = $this->conn->prepare("SELECT UserID FROM users WHERE UserID = ?");
        $checkUserStmt->bind_param("i", $userID);
        $checkUserStmt->execute();
        $checkUserStmt->store_result();
    
        // Fetch the result
        $checkUserStmt->bind_result($resultUserID);
        $checkUserStmt->fetch();
    
        if ($checkUserStmt->num_rows > 0) {
            // User exists, proceed to register job seeker
            $stmt = $this->conn->prepare("INSERT INTO jobseekers (UserID, FirstName, LastName, Phone) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $userID, $firstName, $lastName, $phone);
    
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return "Error during registration: " . $stmt->error;
            }
        } else {
            // User does not exist, handle the situation accordingly
            return "Error during registration: User does not exist";
        }
    
        // Close the $checkUserStmt
        $checkUserStmt->close();
    }
    

    // Add other methods related to job seekers as needed...

}
?>
