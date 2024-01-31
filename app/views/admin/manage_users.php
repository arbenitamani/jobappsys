<?php
require_once '../../controllers/AdminController.php';

class Admin {
    public function showUsers($users) {
        echo "<table class='tableusers' border='1'>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
            </tr>";

        if (!empty($users)) {
            foreach ($users as $user) {
                echo "<tr>
                    <td>{$user['UserID']}</td>
                    <td><span class='editable' data-field='UserName' data-id='{$user['UserID']}'>{$user['UserName']}</span><button class='edit-btn'>Edit</button></td>
                    <td><span class='editable' data-field='Email' data-id='{$user['UserID']}'>{$user['Email']}</span><button class='edit-btn'>Edit</button></td>
                    <td><a href='?action=delete&id={$user['UserID']}' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }

        echo "</table>";
    }
}
?>
