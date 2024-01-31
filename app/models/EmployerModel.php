<?php
require_once 'User.php';

// EmployerModel.php

class Employer {
    private $conn; // Define the $conn property

    // Constructor to initialize the $conn property
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Other methods of the Employer class...
    
    // Method to register an employer
    public function registerEmployer($userID, $companyName, $industry, $contactInfo) {
        // Use $this->conn to access the database connection

        // Example: Prepare and execute a SQL statement
        $stmt = $this->conn->prepare("INSERT INTO employers (UserID, CompanyName, Industry, ContactInfo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $userID, $companyName, $industry, $contactInfo);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Registration successful
            $stmt->close();
            return true;
        } else {
            // Registration failed
            $stmt->close();
            return "Error during registration: " . $stmt->error;
        }
    }

    // Other methods of the Employer class...
}

?>