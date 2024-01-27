<!-- // controllers/UserController.php -->
<?php
require_once '../models/User.php';
require_once '../models/Admin.php';
require_once '../models/JobSeeker.php';
require_once '../models/Employer.php';
 

class UserController {
    public function registerAdmin($data) {
        // Implement registration logic for Admin
    }

    public function registerJobSeeker($data) {
        // Implement registration logic for JobSeeker
    }

    public function registerEmployer($data) {
        // Implement registration logic for Employer
    }

    public function login($data) {
        // Implement login logic
    }

    public function updateProfile($data) {
        // Implement update profile logic
    }
}

// Example of usage
$userController = new UserController();
$userController->registerAdmin($adminData);
$userController->registerJobSeeker($jobSeekerData);
$userController->registerEmployer($employerData);
$userController->login($loginData);
$userController->updateProfile($updateData);
?>