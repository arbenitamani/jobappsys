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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                <button type="submit" name="sort" value="alphabetical">Sort Alphabetically</button>
            </form>
        </div>

        <div class="jobs">
            <?php
            // Define the bubble sort function
            function bubbleSort(&$arr) {
                $n = count($arr);
                for ($i = 0; $i < $n-1; $i++) {
                    for ($j = 0; $j < $n-$i-1; $j++) {
                        if (strcasecmp($arr[$j], $arr[$j+1]) > 0) {
                            // Swap $arr[$j] and $arr[$j+1]
                            $temp = $arr[$j];
                            $arr[$j] = $arr[$j+1];
                            $arr[$j+1] = $temp;
                        }
                    }
                }
            }

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

            // Check if sorting option is selected
            $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

            // Fetch job posts data from the database
            $sql = "SELECT * FROM jobposts";
            
            if ($sort == 'alphabetical') {
                // Fetch job titles for sorting
                $sql = "SELECT Title FROM jobposts";
                $result = $conn->query($sql);
                $jobTitles = array(); // Array to store job titles

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $jobTitles[] = $row["Title"]; // Add title to the array
                    }

                    // Apply sorting using bubble sort
                    bubbleSort($jobTitles);

                    // Display sorted job titles
                    foreach ($jobTitles as $title) {
                        $sql = "SELECT * FROM jobposts WHERE Title = '$title'";
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
                    }
                } else {
                    echo "No job posts found.";
                }
            } else {
                // Default behavior without sorting
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
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>
