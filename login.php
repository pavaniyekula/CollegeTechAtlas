<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeinfo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($password == $row["password"]) {
            session_start();
            $_SESSION["email"] = $email; // Store the user's email in the session
            header("Location: dashboard.php"); // Redirect to the logged-in page
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}

$conn->close();
?>
