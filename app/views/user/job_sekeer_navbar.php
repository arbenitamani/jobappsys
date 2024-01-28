<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Navbar</title>
    <style>
        /* Basic CSS for navbar */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: orange;
          height: 50px;
            width: 100%;
            margin: 0;
          
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        nav ul li {
            float: right;
        }

        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav ul li a:hover {
            color: black;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
        <li><a href="../../../index.php">Home</a></li>

            <li><a href="./job_seeker_profile.php">My Profile</a></li>
            <li><a href="../job/job_list.php">Browse Jobs</a></li>
        </ul>
    </nav>

    <!-- Your content goes here -->
</body>
</html>