<?php
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

// Delete user if requested
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE UserID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

// Update user information if requested
if (isset($_POST['action']) && $_POST['action'] == 'update' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $field = $_POST['field'];
    $value = $_POST['value'];
    $sql = "UPDATE users SET $field='$value' WHERE UserID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

// Insert new user if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_username']) && isset($_POST['new_email'])) {
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    
    $sql = "INSERT INTO users (UserName, Email) VALUES ('$new_username', '$new_email')";
    
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        $new_user = array("UserID" => $last_id, "UserName" => $new_username, "Email" => $new_email);
        echo json_encode($new_user);
        exit();
    } else {
        echo "Error creating user: " . $conn->error;
    }
}

// Fetch all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            color: white;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .editable {
            cursor: pointer;
        }
        .edit-btn {
            float: right;
        }
        #edit-success-msg, #create-success-msg {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 10px;
            display: none;
        }
        .create-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .create-form {
            display: none;
        }
    </style>
</head>
<body>
    
    <h2>User Management</h2>
    <button class="create-btn" onclick="toggleCreateForm()">Create User</button>
    <form class="create-form" style="margin-top: 10px;" method="post" action="">
        <input type="text" name="new_username" placeholder="Username" required>
        <input type="email" name="new_email" placeholder="Email" required>
        <button type="submit">Create</button>
    </form>
    <table class="tableusers" border="1">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["UserID"] . "</td>";
                echo "<td><span class='editable' data-field='UserName' data-id='" . $row["UserID"] . "'>" . $row["UserName"] . "</span><button class='edit-btn'>Edit</button></td>";
                echo "<td><span class='editable' data-field='Email' data-id='" . $row["UserID"] . "'>" . $row["Email"] . "</span><button class='edit-btn'>Edit</button></td>";
                echo "<td><a href='?action=delete&id=" . $row["UserID"] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
    </table>

    <div id="edit-success-msg" style="display: none;">User edited successfully</div>
    <div id="create-success-msg" style="display: none;">User created successfully</div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const editableFields = document.querySelectorAll('.editable');
        const editBtns = document.querySelectorAll('.edit-btn');

        editableFields.forEach(field => {
            field.addEventListener('click', function() {
                editField(this);
            });
        });

        editBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const field = this.parentNode.querySelector('.editable');
                editField(field);
            });
        });

        function editField(field) {
            const currentValue = field.textContent;
            const input = document.createElement('input');
            input.value = currentValue;
            field.textContent = '';
            field.appendChild(input);
            input.focus();

            input.addEventListener('blur', function() {
                const newValue = this.value;
                const id = field.dataset.id;
                const fieldName = field.dataset.field;

                // Send AJAX request to update user information
                const xhr = new XMLHttpRequest();
                xhr.open('POST', window.location.href);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        field.textContent = newValue;
                        document.getElementById('edit-success-msg').style.display = 'block';
                        setTimeout(() => {
                            document.getElementById('edit-success-msg').style.display = 'none';
                        }, 3000);
                    } else {
                        console.error('Failed to update user information');
                    }
                };
                xhr.send(`action=update&id=${id}&field=${fieldName}&value=${newValue}`);
            });
        }

        const createBtn = document.querySelector('.create-btn');
        createBtn.addEventListener('click', function() {
            toggleCreateForm();
        });

        function toggleCreateForm() {
            const createForm = document.querySelector('.create-form');
            createForm.style.display = (createForm.style.display === 'none' || createForm.style.display === '') ? 'block' : 'none';
        }

        // Handle the submission of the create user form
        const createForm = document.querySelector('.create-form');
        createForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(createForm);
            const xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.href);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('create-success-msg').style.display = 'block';
                    setTimeout(() => {
                        document.getElementById('create-success-msg').style.display = 'none';
                        // Reload the table content
                        location.reload();
                    }, 2000);
                } else {
                    console.error('Failed to create user');
                }
            };
            xhr.send(formData);
        });
        
        // Function to add a new user row to the table
        function addUserToTable(user) {
            const tableBody = document.querySelector('.tableusers tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${user.UserID}</td>
                <td><span class='editable' data-field='UserName' data-id='${user.UserID}'>${user.UserName}</span><button class='edit-btn'>Edit</button></td>
                <td><span class='editable' data-field='Email' data-id='${user.UserID}'>${user.Email}</span><button class='edit-btn'>Edit</button></td>
                <td><a href='?action=delete&id=${user.UserID}' onclick='return confirm("Are you sure you want to delete this user?")'>Delete</a></td>
            `;
            tableBody.appendChild(newRow);
            // Attach event listeners to the new row
            const newEditableFields = newRow.querySelectorAll('.editable');
            const newEditBtns = newRow.querySelectorAll('.edit-btn');
            newEditableFields.forEach(field => {
                field.addEventListener('click', function() {
                    editField(this);
                });
            });
            newEditBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const field = this.parentNode.querySelector('.editable');
                    editField(field);
                });
            });
        }
    });
    </script>
</body>
</html>
