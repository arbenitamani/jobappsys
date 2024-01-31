<?php
// UserController.php
require_once '../models/UserService.php';

class UserServiceController
{
    private $userService;
    private $dbConnection;

    public function __construct($dbConnection)
    {
        $this->userService = new UserService();
        $this->dbConnection = $dbConnection;
    }

    public function registerEmployer($userData)
    {
        $employer = $this->userService->createUser('employer', $this->dbConnection, $userData);
        return $employer->registerEmployer($userData['userID'], $userData['companyName'], $userData['industry'], $userData['contactInfo']);
    }

    public function registerJobSeeker($userData)
    {
        $jobSeeker = $this->userService->createUser('jobseeker', $this->dbConnection, $userData);
        return $jobSeeker->registerJobSeeker($userData['userID'], $userData['firstName'], $userData['lastName'], $userData['phone']);
    }
}




$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobappdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Lidhja deshtoi" . $conn->connect_error);
}

$userController = new UserServiceController($conn);

// Example user data
$employerData = [
    'userID' => 1,
    'companyName' => 'Example Corp',
    'industry' => 'Tech',
    'contactInfo' => 'contact@example.com'
];

$jobSeekerData = [
    'userID' => 2,
    'firstName' => 'John',
    'lastName' => 'Doe',
    'phone' => '123-456-7890'
];

// Register an employer
$registrationResult1 = $userController->registerEmployer($employerData);
if ($registrationResult1 === true) {
    echo "Employer registration successful.";
} else {
    echo "Error during employer registration: $registrationResult1";
}

// Register a job seeker
$registrationResult2 = $userController->registerJobSeeker($jobSeekerData);
if ($registrationResult2 === true) {
    echo "Job seeker registration successful.";
} else {
    echo "Error during job seeker registration: $registrationResult2";
}


?>