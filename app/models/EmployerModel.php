<?php
require_once 'User.php';
    class Employer extends User
    {
        private $conn;
        private $userID;
        private $companyName;
        private $industry;
        private $contactInfo;
    
        public function __construct($conn)
        {
            parent::__construct($conn);
            $this->conn = $conn;
        }

    
    public function registerEmployer($userID, $companyName, $industry, $contactInfo) {
    

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

    
}

?>