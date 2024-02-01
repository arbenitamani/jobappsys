<?php
require_once '../../models/config/database.php';
require_once '../../models/Admin.php';

class AdminController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'update':
                        $id = $_POST['id'];
                        $field = $_POST['field'];
                        $value = $_POST['value'];
                        $this->editUser($id, $field, $value);
                        break;
                    case 'create':
                        $new_username = $_POST['new_username'];
                        $new_email = $_POST['new_email'];
                        // For testing purposes, you might want to add the creation of a new user to see if it's working
                        $this->handleCreateUser($new_username, $new_email);
                        break;
                }
            }
        } elseif (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'delete':
                    $id = $_GET['id'];
                    $this->handleDeleteUser($id);
                    break;
                // Add more cases for other actions if needed
            }
        }
     
        // No need to call getUsers() here since it's called in the manage_users.php file
    }
    public function getUsers() {
        return $this->model->getUsers();
    }

    public function editUser($id, $field, $value) {
        $success = $this->model->updateUser($id, $field, $value);
        if ($success) {
            echo "User updated successfully";
        } else {
            echo "Error updating user";
        }
    }

    private function handleDeleteUser($id) {
        $this->model->deleteUser($id);
    }

    private function handleCreateUser($new_username, $new_email) {
        $newUser = $this->model->createUser($new_username, $new_email);
        if ($newUser) {
            // For testing purposes, you might want to return some indication that the user was created successfully
            echo "User created successfully";
        } else {
            echo "Error creating user";
        }
    }
}
?>
