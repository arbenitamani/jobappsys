<?php
require_once 'models/Employer.php';
require_once 'config/database.php';

class EmployerController {
    public function registerEmployerManually($data) {
        global $conn;

        // Hash the password
        $hashedPassword = password_hash($data['Password'], PASSWORD_DEFAULT);

        // Example: Insert employer data into the database manually
        $sqlInsert = "INSERT INTO employers (UserName, Email, Password, CompanyName, Industry, ContactInfo)
                      VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sqlInsert);

        if ($stmt) {
            $stmt->bind_param(
                "ssssss",
                $data['UserName'],
                $data['Email'],
                $hashedPassword,
                $data['CompanyName'],
                $data['Industry'],
                $data['ContactInfo']
            );

            $result = $stmt->execute();
            $stmt->close();

            return $result;
        } else {
            return false;
        }
    }
}
?>
