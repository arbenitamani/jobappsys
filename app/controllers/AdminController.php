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
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'delete':
                    $id = $_GET['id'];
                    $this->handleDeleteUser($id);
                    break;
                // Add more cases for other actions if needed
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'update':
                        $id = $_POST['id'];
                        $field = $_POST['field'];
                        $value = $_POST['value'];
                        $this->handleUpdateUser($id, $field, $value);
                        break;
                    case 'create':
                        $new_username = $_POST['new_username'];
                        $new_email = $_POST['new_email'];
                        $this->handleCreateUser($new_username, $new_email);
                        break;
                }
            }
        }

        $users = $this->model->getUsers();
        $this->view->showUsers($users);
    }
    public function editUser($id, $field, $value) {
        $success = $this->model->updateUser($id, $field, $value);
        if ($success) {
            echo "User updated successfully";
        } else {
            echo "Error updating user: " . $this->model->getConn()->error;
        }
    }

    private function handleDeleteUser($id) {
        $this->model->deleteUser($id);
    }

    private function handleUpdateUser($id, $field, $value) {
        $this->model->updateUser($id, $field, $value);
    }

    private function handleCreateUser($new_username, $new_email) {
        $newUser = $this->model->createUser($new_username, $new_email);
        if ($newUser) {
            echo json_encode($newUser);
            exit();
        } else {
            echo "Error creating user";
        }
    }
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobappdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$model = new AdminModel($conn);
$view = new Admin();
$controller = new AdminController($model, $view);
$controller->handleRequest();

$conn->close();
?>
