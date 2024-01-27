<?php
require '.../models/Admin.php';
require '.../config/database.php';

class AdminController {
    public function registerAdminManually($data) {
        global $conn;

        // Hash the password
        $hashedPassword = password_hash($data['Password'], PASSWORD_DEFAULT);

        // Example: Insert admin data into the database manually
        $sqlInsert = "INSERT INTO admins (UserName, Email, Password, FirstName, LastName, Department)
                      VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sqlInsert);

        if ($stmt) {
            $stmt->bind_param(
                "ssssss",
                $data['UserName'],
                $data['Email'],
                $hashedPassword,
                $data['FirstName'],
                $data['LastName'],
                $data['Department']
            );

            $result = $stmt->execute();
            $stmt->close();

            return $result;
        } else {
            return false;
        }
    }
}

// Instantiate the AdminController
$adminController = new AdminController();

// Directly register the admin with specific values
$result = $adminController->registerAdminManually([
    'UserName' => 'admin123',
    'Email' => 'admin@example.com',
    'Password' => 'adminpassword',
    'FirstName' => 'John',
    'LastName' => 'Doe',
    'Department' => 'HR'
]);

// Check the result
if ($result) {
    echo "Admin registration successful!";
} else {
    echo "Admin registration failed!";
}
?>
