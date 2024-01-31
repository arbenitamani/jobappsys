<?php
require_once 'User.php';

class AdminModel extends User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        } else {
            return [];
        }
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE UserID=$id";
        return $this->conn->query($sql);
    }

    public function updateUser($id, $field, $value) {
        $sql = "UPDATE users SET $field='$value' WHERE UserID=$id";
        return $this->conn->query($sql);
    }

    public function createUser($new_username, $new_email) {
        $sql = "INSERT INTO users (UserName, Email) VALUES ('$new_username', '$new_email')";
        $result = $this->conn->query($sql);

        if ($result) {
            $last_id = $this->conn->insert_id;
            $new_user = array("UserID" => $last_id, "UserName" => $new_username, "Email" => $new_email);
            return $new_user;
        } else {
            return false;
        }
    }
}
?>
