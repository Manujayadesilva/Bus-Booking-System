<?php
// Database connection parameters
$db_host = 'localhost';
$db_user = 'dseuser';
$db_password = '123';
$db_db = 'voyagefacile1';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the database
$sql = "SELECT * FROM tourpackage_order";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View - Tour Package Orders</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bus-icon {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .travelling-aid {
            font-size: 2em;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header class="navbar navbar-dark bg-dark">
        <div class="container">
            <img src="bus icon.webp" alt="Bus Icon" class="bus-icon">
            <span class="text-white travelling-aid">Voyage Facile</span>
            <h1 class="text-white">(Admin View - Tour Package Orders)</h1>
        </div>
    </header>

    <div class="container mt-3">
        <h2>Bookings</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Mobile Number</th>
                    <th>Nationality</th>
                    <th>Package Name</th>
                    <th>Travel Date</th>
                    <th>Number of Adults</th>
                    <th>Number of Children</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['FullName'] . "</td>";
                        echo "<td>" . $row['MobileNumber'] . "</td>";
                        echo "<td>" . $row['Nationality'] . "</td>";
                        echo "<td>" . $row['PackageName'] . "</td>";
                        echo "<td>" . $row['TravelDate'] . "</td>";
                        echo "<td>" . $row['NumberOfAdults'] . "</td>";
                        echo "<td>" . $row['NumberOfChildren'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No bookings found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="adminselection.html" class="btn btn-secondary">Back to Admin Selection</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
