<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "jobappdb";

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Lidhja deshtoi" . $conn->connect_error);
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 15px;
    border-bottom: 2px solid rgb(99, 132, 225);
        }


    .navbar img {
        height: 40px;
        width: 40px;
        object-fit: contain;
    }

    .navbar ul {
        padding-left: 0;
        list-style-type: none;
        display: flex;
    }

        .navbar li {
            padding-left: 10px;
        }

            .navbar a {
                text-decoration: none;
                font-size: 18px;
                font-weight: 500;
                color: rgb(35, 45, 159);
            }
        

.home-all {
    display: flex;
    flex-direction: row;
}

.home-left {
    position: relative;
    flex: 1;
}

 img {
    width: 100%;
    height: auto;
    display: block;

}

.home-right {
    position: absolute;
    top: 50%;
    left: 80%;
    transform: translate(-50%, -50%);
    z-index: 1;
    padding: 20px;
    text-align: right;  
   width: 30%; 
   height: 70%;
    border-radius: 20px; 
}

.home-right h1 {
    font-size: 2.7rem;

    margin-bottom: 20px;
    color: white;
    text-shadow: 5px 5px 4px rgba(0, 0, 0, 0.3); 
}

.home-right p {
    font-size: 1.2rem;
     font-weight: 500;
    color: #535353; 
    margin-bottom: 20%; 
    color: rgb(21, 34, 118);

}

.home-right button {
    padding: 10px 20px; 
    font-size: 1rem; 
    background-color: #023d7d; 
    color: #fff; 
    border: none;
    border-radius: 5px; 
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.home-right button:hover {
    background-color: #0056b3; 
}
    </style>
</head>
<body>
<div class="navbar">
        <img src="images/logo.svg" alt='Logo' />
        <ul>
            <li>
                <a href="./login.php">Login</a>
            </li>
            <li>
            <a href="./register.php">Register</a>
            </li>
          
        </ul>
    </div>
    <div class="home-wrapper">
            <div class="home-all">
                <div class="home-left">
                    <img src="images/job5.jpg" alt="" />
                </div>
                <div class="home-right">
                       <h1>
                       WorkWise
                       </h1> 
                       <p>Are you ready to unlock endless opportunities and take your career to new heights? Look no further! Your Career Catalyst is here to empower you on your journey to success. Whether you're a seasoned professional or just starting out, we've got the tools, resources, and job listings tailored to your needs.</p>
                       <button>Find out more</button>
                </div>

            </div>

        </div>
</body>
</html>

