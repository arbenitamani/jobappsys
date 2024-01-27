<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" href="./choose.css">
</head>
<body>
    <div class="choose-wrapper">
        <div class="choosebox">
            <h1>Join us as a Employer or </h1>

            <div class="boxes">
                <div class="box" id="employerBox">
                    <h1>I'm an Employer</h1>
                </div>
                <div class="box" id="userBox">
                    <h1>I am a User</h1>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("employerBox").addEventListener("click", function() {
            window.location.href = "employer.php"; 
        });

        document.getElementById("userBox").addEventListener("click", function() {
            window.location.href = "user.php"; 
        });
    </script>
</body>
</html>
