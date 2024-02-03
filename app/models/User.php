<?php
class User
{
    private $conn;
    private $userID;
    private $userName;
    private $email;
    private $password;
    private $connectionInitialized = false;

    public function __construct()
    {
    }

    private function initializeConnection()
    {
        if (!$this->connectionInitialized) {
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "jobappdb";

            // Create connection
            $this->conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }

            $this->connectionInitialized = true;
        }
    }

    public function register($username, $email, $password)
    {
        // Lazy initialization of the database connection
        $this->initializeConnection();

        // You can use these attributes in your database operations
        $this->userName = $username;
        $this->email = $email;
        $this->password = $password;

        // Example: $this->conn->query("INSERT INTO users (UserName, Email, Password) VALUES (?, ?, ?)", [$this->userName, $this->email, $this->password]);
    }
}

?>