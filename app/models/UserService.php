<?php
// UserService.php
require_once 'EmployerModel.php';
require_once 'JobSeeker.php';

class UserService
{
    public static function createUser($userType, $conn, $userData)
    {
        switch ($userType) {
            case 'employer':
                return new Employer($conn);
                break;
            case 'jobseeker':
                return new JobSeeker($conn);
                break;
            default:
                throw new Exception("Invalid user type specified.");
        }
    }
}

?>


