<?php
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
                    <td>{$user['UserName']}</td>
                    <td>{$user['Email']}</td>
                    <td><a href='?action=edit&id={$user['UserID']}'>Edit</a> | <a href='?action=delete&id={$user['UserID']}' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }

        echo "</table>";
    }
}
?>
