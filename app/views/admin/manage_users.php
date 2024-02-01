<?php
require_once '../../controllers/AdminController.php';
require_once '../../models/AdminModel.php';
require_once '../../models/config/database.php';

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

// Retrieve users from the model
$users = $controller->getUsers();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 0%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
            font-size: 40px;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: white;
        }

        input[type="text"],
        input[type="email"] {
            width: 50%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            color: white;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        .editable {
            cursor: pointer;
            display: inline-block;
            min-width: 100px;
        }

        .edit-btn {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 5px 10px;
            margin-left: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .edit-btn:hover {
            background-color: #218838;
        }

        .delete{
            cursor: pointer;
            background-color: red;
         width: 100px; 
         height: 30px;
         
            text-decoration: none;
            padding: 5px 10px;
            margin-left: 10px;
            border-radius: 4px;
              border: none;
              color: white;
        }
        .delete-link {
          
            cursor: pointer;
            background-color: #28a745;


        }

        .delete-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>Manage Users</h1>

<!-- Form for creating a new user -->
<form method="POST" action="">
    <label for="new_username">Username:</label>
    <input type="text" name="new_username" id="new_username" required>
    <label for="new_email">Email:</label>
    <input type="email" name="new_email" id="new_email" required>
    <input type="hidden" name="action" value="create">
    <button type="submit">Create User</button>
</form>

<table class='tableusers' border='1'>
    <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['UserID'] ?></td>
            <td><span class='editable' data-field='UserName' data-id='<?= $user['UserID'] ?>' data-type='username'><?= $user['UserName'] ?></span><button class='edit-btn' data-type='username'>Edit</button></td>
            <td><span class='editable' data-field='Email' data-id='<?= $user['UserID'] ?>' data-type='email'><?= $user['Email'] ?></span><button class='edit-btn' data-type='email'>Edit</button></td>
            <td><a class="delete" href='?action=delete&id=<?= $user['UserID'] ?>' onclick='return confirm("Are you sure you want to delete this user?")'>Delete</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var editButtons = document.querySelectorAll(".edit-btn");
    editButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            var type = button.dataset.type; // Get the type of field being edited
            var row = button.closest("tr"); // Find the parent row of the button
            var userID = row.querySelector(".editable[data-type='" + type + "']").dataset.id; // Select the correct editable element based on type
            var field = button.parentElement.querySelector(".editable[data-type='" + type + "']").dataset.field; // Select the correct field based on type
            var value = button.parentElement.querySelector(".editable[data-type='" + type + "']").textContent.trim(); // Select the correct value based on type
            var newValue = prompt("Enter new value for " + field, value);
            if (newValue !== null) {
                // Send AJAX request to update user
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            alert(xhr.responseText);
                            // Refresh page or update UI as needed
                            location.reload(); // Refreshes the page
                        } else {
                            alert("Error updating user");
                        }
                    }
                };
                xhr.open("POST", "../../controllers/AdminController.php", true); // Update the path accordingly
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("action=update&id=" + userID + "&field=" + field + "&value=" + encodeURIComponent(newValue));
            }
        });
    });
});

</script>
</body>
</html>
