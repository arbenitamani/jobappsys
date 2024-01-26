<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
    <style>
        .user-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .user-container {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }
        .user-info {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jobappdb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to retrieve user data
    $sql = "SELECT * FROM users";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='user-grid'>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class='user-container'>";
            echo "<div class='user-info'>UserID: " . $row["UserID"]. "</div>";
            echo "<div class='user-info'>UserName: " . $row["UserName"]. "</div>";
            echo "<div class='user-info'>Email: " . $row["Email"]. "</div>";
            echo "</div>";
        }
        echo "</div>"; // Close user-grid div
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
</body>
</html>
