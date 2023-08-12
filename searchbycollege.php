<!DOCTYPE html>
<html>
<head>
    <title>Search by College - CollegeTechAtlas</title>
    <link rel="stylesheet" href="mainwebpagecss.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .nav-container {
            background-color: #E0E5FA;
            padding: 10px;
        }

        .nav-heading h1 {
            margin: 0;
            color:#000000
            font-size: 24px;
        }

        .search-by-college-container {
            text-align: center;
            margin: 20px auto;
            max-width: 500px;
        }

        .search-by-college-container h2 {
            margin-bottom: 10px;
        }

        .search-form {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
	
	    .search-form label {
            margin-right: 10px;
            font-size: 18px;
        }

        .search-form input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        .search-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

	    .search-results-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-image: url('searchbycollegeimage.jpg');
            background-size: cover;
            background-position: center;
            opacity: 0.9; /* Change opacity to your desired value */
        }
	
	    .college-details {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
        }

        .college-details strong {
            font-weight: bold;
        }

        .no-data-found {
            text-align: center;
            font-size: 18px;
            color: #ff0000;
        }
        
        .college-search-results {
        max-width: 800px;
        margin: 20px auto;
        padding: 0px;
        width: 770px;
        border: 1px solid #ccc;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        background-color: #e0e5fa;
        }
</style>
</head>
<body>
    <div class="nav-container">
        <div class="nav-heading">
            <h1>CollegeTechAtlas</h1>
        </div>
    </div>

    <div class="search-by-college-container">
        <h2>Search by College</h2>
        <form method="POST" action="" class="search-form">
            <label for="college_name">Enter College Name:</label>
            <input type="text" name="college_name" id="college_name" required>
            <input type="submit" value="Search">
        </form>
    </div>

    <div class="college-search-results">
    <?php

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
	        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the college name from the form submission
            $collegeName = $_POST["college_name"];

            // Sanitize the input to prevent SQL injection
            $collegeName = mysqli_real_escape_string($dbConnection, $collegeName);

            // Query the database to get the data for the specified college
            $query = "SELECT * FROM dataset WHERE CollegeName LIKE '%$collegeName%'";
            $result = mysqli_query($dbConnection, $query);

            // Check if any matching record is found
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='college-details'>";
                    echo "<strong>College Name:</strong> " . $row['CollegeName'] . "<br>";
                    echo "<strong>Genders Accepted:</strong> " . $row['GendersAccepted'] . "<br>";
                    echo "<strong>Campus Size:</strong> " . $row['CampusSize'] . "<br>";
                    echo "<strong>Total Student Enrollments:</strong> " . $row['TotalStudentEnrollments'] . "<br>";
                    echo "<strong>Total Faculty:</strong> " . $row['TotalFaculty'] . "<br>";
                    echo "<strong>Established Year:</strong> " . $row['EstablishedYear'] . "<br>";
                    echo "<strong>Rating:</strong> " . $row['Rating'] . "<br>";
                    echo "<strong>University:</strong> " . $row['University'] . "<br>";
                    echo "<strong>Courses:</strong> " . $row['Courses'] . "<br>";
                    echo "<strong>Facilities:</strong> " . $row['Facilities'] . "<br>";
                    echo "<strong>City:</strong> " . $row['City'] . "<br>";
                    echo "<strong>State:</strong> " . $row['State'] . "<br>";
                    echo "<strong>Country:</strong> " . $row['country'] . "<br>";
                    echo "<strong>College Type:</strong> " . $row['CollegeType'] . "<br>";
                    echo "<strong>Average Fees:</strong> " . $row['AverageFees'] . "<br>";
                    echo "</div>";
                }
            } else {
                // College not found in the database, display an error message
                echo "<h3>No data found for the specified college.</h3>";
            }

            // Close the database connection
            mysqli_close($dbConnection);
        }

        

        ?>
    </div>
</body>
</html>
