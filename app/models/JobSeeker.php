<?php
require_once 'User.php';
class JobSeeker extends User {
    protected $FirstName;
    protected $LastName;
    protected $Phone;
    protected $Resume;

    public function __construct($UserID, $UserName, $Email, $Password, $FirstName, $LastName, $Phone, $Resume) {
        parent::__construct($UserID, $UserName, $Email, $Password);
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Phone = $Phone;
        $this->Resume = $Resume;
    }

    // Additional methods specific to JobSeeker
}
?>