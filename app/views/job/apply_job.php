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
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $row['Title']; ?></title>
            <link rel="stylesheet" href="./apply_job.css">
        </head>

        <body>
            <div class="job-wrapper">
                <div>
                     <a href="./job_list.php" class="x">X</a>  
                </div>
             
                  <div class="job-details">
                <img src="../../../images/jd.png" alt="">
                <h2><?php echo $row['Title']; ?></h2>
                <p><strong>Location:</strong> <?php echo $row['Location']; ?></p>
                <p><strong>Description:</strong> <br><?php echo $row['Description']; ?></p>
                <p><strong>Qualifications:</strong> <br><?php echo $row['Qualifications']; ?></p>
                <p><strong>Salary:</strong>  <?php echo $row['Salary']; ?></p>
                <!-- Add more details as needed -->
                <a href="">Apply</a>
            </div>   
            </div>
       
        </body>

        </html>
        <?php
    } else {
        echo "No job post found with that ID.";
    }
} else {
    echo "No job post ID provided.";
}

// Close the database connection
$conn->close();
?>
