<!DOCTYPE html>
<html>
<head>
    <title>Sample Table Data</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php
    $host = 'localhost'; 
    $database = 'pavani';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM sample");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    if (!empty($data)) {
        echo '<table>';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th>Gender</th>';
        echo '<th>Age</th>';
        echo '</tr>';
        foreach ($data as $row) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['gender']) . '</td>';
            echo '<td>' . htmlspecialchars($row['age']) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No data found in the table.</p>';
    }
    ?>
</body>
</html>
