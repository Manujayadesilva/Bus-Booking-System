<?php
// Establish database connection (replace these variables with your actual database credentials)
$servername = "localhost";
$username = "dseuser";
$password = "123";
$dbname = "voyagefacile1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch bus data from highwaybusAdd table
$sql = "SELECT id, highway_bus_name FROM highwaybusAdd";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch data and store in an associative array (key: highway_bus_name, value: id)
    $busData = array();
    while ($row = $result->fetch_assoc()) {
        $busData[$row['highway_bus_name']] = $row['id']; // Use highway_bus_name as key and id as value
    }

    // Output the data as JSON
    header('Content-Type: application/json');
    echo json_encode($busData);
} else {
    // No data found
    echo "0 results";
}

// Close connection
$conn->close();
?>
