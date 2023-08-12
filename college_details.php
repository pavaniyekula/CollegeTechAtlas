<?php
// college_details.php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'error_log.txt');

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeinfo";

// Establish the database connection
$dbConnection = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the college parameter is passed in the URL
if (isset($_GET["college"])) {
    // Retrieve the college name from the URL parameter and sanitize it
    $collegeName = mysqli_real_escape_string($dbConnection, $_GET["college"]);

    // Query the database to get the detailed information about the selected college
    $query = "SELECT * FROM dataset WHERE CollegeName = '$collegeName'";
    $result = mysqli_query($dbConnection, $query);

    // Check if any matching record is found
    if (mysqli_num_rows($result) > 0) {
        $collegeData = mysqli_fetch_assoc($result);
    } else {
        // College not found in the database, display an error message or redirect to an error page
        die("College not found.");
    }

    // Close the database connection
    mysqli_close($dbConnection);
} else {
    // If the college parameter is not passed, display an error message or redirect to an error page
    die("College not specified.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CollegeTechAtlas - <?php echo $collegeData['CollegeName']; ?></title>
    <!-- Add your CSS and other necessary stylesheets here -->
</head>
<body>
    <!-- Display the detailed information about the selected college here -->
    <h2><?php echo $collegeData['CollegeName']; ?></h2>
    <!-- Add other relevant details and information here -->
    <p><strong>Genders Accepted:</strong> <?php echo $collegeData['GendersAccepted']; ?></p>
    <p><strong>Campus Size:</strong> <?php echo $collegeData['CampusSize']; ?></p>
    <p><strong>Total Student Enrollments:</strong> <?php echo $collegeData['TotalFaculty']; ?></p>
    <p><strong>Total Faculty:</strong> <?php echo $collegeData['EstablishedYear']; ?></p>
    <p><strong>Established Year:</strong> <?php echo $collegeData['EstablishedYear']; ?></p>
    <p><strong>Rating:</strong> <?php echo $collegeData['Rating']; ?></p>
    <p><strong>University:</strong> <?php echo $collegeData['University']; ?></p>
    <p><strong>Courses:</strong> <?php echo $collegeData['Courses']; ?></p>
    <p><strong>Facilities:</strong> <?php echo $collegeData['Facilities']; ?></p>
    <p><strong>City:</strong> <?php echo $collegeData['City']; ?></p>
    <p><strong>State:</strong> <?php echo $collegeData['State']; ?></p>
    <p><strong>Country:</strong> <?php echo $collegeData['Country']; ?></p>
    <p><strong>College Type:</strong> <?php echo $collegeData['CollegeType']; ?></p>
    <p><strong>AverageFees:</strong> <?php echo $collegeData['AverageFees']; ?></p>
</body>
</html>
