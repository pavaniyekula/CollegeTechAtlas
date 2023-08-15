<?php
    $email_i = $_POST["email"];
    $password_i = $_POST["password"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "collegeinfo";

    $conn_database = mysqli_connect($servername, $username, $password, $database);
    if (!$conn_database) {
        echo "Connection error";
    }

    $sql = "SELECT * FROM `users` WHERE `email`='$email_i' AND `Password`='$password_i';";
    $result = mysqli_query($conn_database, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "Login successful!";
    } else {
        echo "Invalid username or password.";
    }

    mysqli_close($conn_database);
?>
