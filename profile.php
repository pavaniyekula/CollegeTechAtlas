<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["email"])) {
    header("Location: login.html"); // Redirect to the login page if not logged in
    exit();
}

$email = $_SESSION["email"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeinfo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    // You can retrieve other user information here if needed
} else {
    echo "User not found";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="signupcss.css">
    </head>
    <body>
        <h1 class="heading">CollegeTechAtlas</h1>

        <div class="container">
            <div class="image">
                <img src="https://collegetechatlas.s3.amazonaws.com/imagescta/signupimage.png" alt="SignupImage" width="400px" height="400px">
            </div>
            <div class="signup">
                <h2>Your Profile</h2>
                <div class="form">
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <span><?= $firstname ?></span>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <span><?= $lastname ?></span>
                    </div>
                    <!-- Add other user information fields here if needed -->
                </div>
            </div>
        </div>
    </body>
</html>
