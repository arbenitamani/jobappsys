<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobPosts</title>
    <link rel="stylesheet" href="./joblist.css">
</head>

<body>

    <div class="joblist-wrapper">

        <div class="listnav">
            <h2>JobPosts</h2>
        </div>

        <div class="jobs">
            <?php
            // Database connection parameters
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

            // Fetch job posts data from the database
            $sql = "SELECT * FROM jobposts";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="job">';
                    echo '<div class="job-left">';
                    echo '<div>';
                    echo '<h4>' . $row["Title"] . '</h4>';
                    echo '<p>' . $row["Location"] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="job-right">';
                    // Ensure the link includes the jobpost_id parameter
                    echo '<a href="./job_details.php?jobpost_id=' . $row["JobPostID"] . '">Apply for this job</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No job posts found.";
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>
