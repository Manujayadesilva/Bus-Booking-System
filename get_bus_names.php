<?php
// Establish connection to your database
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

// Fetch unique bus names from the highwaybusAdd table
$sql = "SELECT DISTINCT highway_bus_name FROM highwaybusAdd";
$result = $conn->query($sql);

$busNames = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $busNames[] = $row;
    }
    echo json_encode($busNames);
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
