<?php
// Database connection parameters
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

// Retrieve query parameters
$busRoute = $_GET["busRoute"];
$date = $_GET["date"];

// Query to fetch reservation details based on bus route and date
$sql = "SELECT * FROM Reservations WHERE Bus_name = ? AND Date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $busRoute, $date);
$stmt->execute();
$result = $stmt->get_result();

$data = array();

if ($result->num_rows > 0) {
    // Fetching rows and adding them to the data array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close database connection
$stmt->close();
$conn->close();

// Returning JSON response
echo json_encode($data);
?>
