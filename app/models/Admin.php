<?php
require_once 'User.php'; // Adjust the path if needed

class Admin  {
    protected $FirstName;
    protected $LastName;
    protected $Department;

    public function __construct($UserID, $UserName, $Email, $Password, $FirstName, $LastName, $Department) {
        parent::__construct($UserID, $UserName, $Email, $Password);
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Department = $Department;
    }

    // Additional methods specific to Admin
}
?>
