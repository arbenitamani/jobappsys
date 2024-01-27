<?php
require_once '../controllers/EmployerController.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employerController = new EmployerController();

    $employerData = [
        'UserName' => $_POST['UserName'],
        'Email' => $_POST['Email'],
        'Password' => $_POST['Password'],
        'CompanyName' => $_POST['CompanyName'],
        'Industry' => $_POST['Industry'],
        'ContactInfo' => $_POST['ContactInfo'],
    ];

    $result = $employerController->registerEmployerManually($employerData);

    if ($result) {
        echo "Employer registration successful!";
    } else {
        echo "Employer registration failed!";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Registration</title>
</head>
<body>
    <h2>Employer Registration</h2>
    <form action="" method="post">
        <label for="UserName">Username:</label>
        <input type="text" name="UserName" required><br>

        <label for="Email">Email:</label>
        <input type="email" name="Email" required><br>

        <label for="Password">Password:</label>
        <input type="password" name="Password" required><br>

        <label for="CompanyName">Company Name:</label>
        <input type="text" name="CompanyName" required><br>

        <label for="Industry">Industry:</label>
        <input type="text" name="Industry" required><br>

        <label for="ContactInfo">Contact Info:</label>
        <input type="text" name="ContactInfo" required><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
