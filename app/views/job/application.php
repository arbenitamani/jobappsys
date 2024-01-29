<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
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

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        textarea {
            width: 100%;
            height: 100px;
            padding: 5px;
            resize: vertical;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // Include your database connection code
        include '../../config/database.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve data from the form
            $jobpost_id = $_POST['jobpost_id'];
            $user_id = 34; // Assuming you have a way to retrieve the user ID
            
            // Check if cover_letter key exists in $_POST array
            if (isset($_POST['cover_letter'])) {
                $cover_letter = $_POST['cover_letter'];

                // Check if cover letter is not empty
                if (!empty($cover_letter)) {
                    // Insert data into the database
                    $sql = "INSERT INTO applications (UserID, JobPostID, ApplicationDate, Status, CoverLetter)
                            VALUES ('$user_id', '$jobpost_id', CURDATE(), 'Pending', '$cover_letter')";

                    if ($conn->query($sql) === TRUE) {
                        echo "Application submitted successfully";
                        echo '<script>
                                setTimeout(function() {
                                    window.location.href = "./job_list.php"; // Redirect to job list page
                                }, 2000); // 2000 milliseconds = 2 seconds
                              </script>';
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Cover letter cannot be empty";
                }
            } else {
                echo "Write your cover letter and submit the application!";
            }
        }

        // Close the database connection
        $conn->close();
        ?>

        <h2>Apply for Job</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="jobpost_id" value="<?php echo isset($_GET['jobpost_id']) ? $_GET['jobpost_id'] : ''; ?>">
            <div class="form-group">
                <label for="cover_letter">Cover Letter:</label>
                <textarea id="cover_letter" name="cover_letter" rows="4" cols="50"></textarea>
            </div>
            <button type="submit" name="submit">Submit Application</button>
        </form>
    </div>
</body>

</html>
