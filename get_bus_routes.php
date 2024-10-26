<?php
// Establish database connection
$servername = "localhost";
$username = "dseuser";
$password = "123";
$database = "voyagefacile1";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch bus routes from the database
$sql = "SELECT id, highway_bus_name FROM highwaybusAdd";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize an empty array to store bus routes
    $busRoutes = array();

    // Fetch data and store in the array
    while ($row = $result->fetch_assoc()) {
        $busRoutes[] = $row;
    }

    // Output the array as JSON
    echo json_encode($busRoutes);
} else {
    // No data found
    echo json_encode([]);
}

// Close connection
$conn->close();
?>
