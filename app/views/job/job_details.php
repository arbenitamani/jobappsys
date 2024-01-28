<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .job-details {
            margin-bottom: 30px;
        }

        .job-details h2 {
            margin-bottom: 10px;
            font-size: 24px;
        }

        .job-details p {
            margin-bottom: 5px;
        }

        .job-details strong {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // Include your database connection code
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

        // Check if a job post ID is provided in the URL
        if (isset($_GET['jobpost_id'])) {
            // Sanitize the input to prevent SQL injection
            $jobpost_id = mysqli_real_escape_string($conn, $_GET['jobpost_id']);

            // SQL query to retrieve details of the specified job post
            $sql = "SELECT * FROM jobposts WHERE JobPostID = $jobpost_id";

            // Execute the query
            $result = $conn->query($sql);

            // Check if there is exactly one result
            if ($result->num_rows == 1) {
                // Fetch the row
                $row = $result->fetch_assoc();
                ?>
                <div class="job-details">
                    <h2><?php echo $row['Title']; ?></h2>
                    <p><strong>Location:</strong> <?php echo $row['Location']; ?></p>
                    <p><strong>Description:</strong> <?php echo $row['Description']; ?></p>
                    <p><strong>Qualifications:</strong> <?php echo $row['Qualifications']; ?></p>
                    <p><strong>Salary:</strong> <?php echo $row['Salary']; ?></p>
                    <!-- Add more details as needed -->
                </div>
            <?php
            } else {
                echo "<p>No job post found with that ID.</p>";
            }
        } else {
            echo "<p>No job post ID provided.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>

</html>
