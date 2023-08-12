<!DOCTYPE html>
<html>
<head>
    <title>Search by Location - CollegeTechAtlas</title>
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
            color: #000000;
            font-size: 24px;
        }

        .search-by-location-container {
            text-align: center;
            margin: 20px auto;
            max-width: 500px;
        }

        .search-by-location-container h2 {
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

        .college-search-results {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-size: cover;
            background-position: center;
            opacity: 0.9; /* Change opacity to your desired value */
        }
        .college-details strong {
            font-weight: bold;
        }

        .no-data-found {
            text-align: center;
            font-size: 18px;
            color: #ff0000;
        }
        .college-details {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px; /* Add margin for spacing between containers */
            box-sizing: border-box; /* Include padding in width calculation */
            width: calc(25% - 20px); /* Calculate 33.33% width and consider margin */
            display: inline-block;
            vertical-align: top; /* Align containers at the top */
            background-color: #E0E5FA; /* Add background color */
            text-align: center;
        }

        .college-details a {
            text-decoration: none; 
            justify-content: center;
        }

        .college-details button {
            display: block;
            margin-top: 10px;
            text-align: center;
            text-decoration: none;
            background-color: #18294D; /* Change button background color to orange */
            color: #fff; /* Change button text color to white */
            padding: 8px 15px;
            font-size: 16px;
            border: none; /* Remove border for a cleaner look */
            border-radius: 5px;
            cursor: pointer;
            display: flex; /* Use flexbox to center the button */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            width: 100%; /* Make the button full width of the container */
        }

        .college-details button:hover {
            background-color: #0C1424; /* Change button background color to darker orange on hover */
        }

        /* Clearfix to wrap rows correctly */
        .college-search-results::after {
            content: "";
            display: table;
            clear: both;
        }

        @media (max-width: 800px) {
            /* For smaller screens, display two colleges in a row */
            .college-details {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 600px) {
            /* For even smaller screens, display one college in a row */
            .college-details {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="nav-container">
        <div class="nav-heading">
            <h1>CollegeTechAtlas</h1>
        </div>
    </div>

    <div class="search-by-location-container">
        <h2>Search by Location</h2>
        <form method="POST" action="" class="search-form">
            <label for="state_name">Enter State Name:</label>
            <input type="text" name="state_name" id="state_name" required>
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
                // Retrieve the state name from the form submission
                $stateName = $_POST["state_name"];

                // Sanitize the input to prevent SQL injection
                $stateName = mysqli_real_escape_string($dbConnection, $stateName);

                // Query the database to get the data for the colleges in the specified state
                $query = "SELECT CollegeName, City FROM dataset WHERE State LIKE '%$stateName%'";
                $result = mysqli_query($dbConnection, $query);

                // Check if any matching record is found
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='college-details'>";
                        echo "<strong>College Name:</strong> " . $row['CollegeName'] . "<br>";
                        echo "<strong>City:</strong> " . $row['City'] . "<br>";
                        echo "<a href='college_details.php?college=" . urlencode($row['CollegeName']) . "'><button>Know More</button></a>";
                        echo "</div>";
                    }
                } else {
                    // College not found in the database, display an error message
                    echo "<h3 class='no-data-found'>No colleges found in the specified state.</h3>";
                }

                // Close the database connection
                mysqli_close($dbConnection);
            }
        ?>
    </div>
</body>

</html>
