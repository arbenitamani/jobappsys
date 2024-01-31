<?php
class User
{
    private $conn;
    private $userID;
    private $userName;
    private $email;
    private $password;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function register($username, $email, $password)
    {
        // You can use these attributes in your database operations
        $this->userName = $username;
        $this->email = $email;
        $this->password = $password;

        // Example: $this->conn->query("INSERT INTO users (UserName, Email, Password) VALUES (?, ?, ?)", [$this->userName, $this->email, $this->password]);
    }
}
?>