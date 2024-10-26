<?php
// Establish database connection (replace these variables with your actual database credentials)
$servername = "localhost";
$username = 'dseuser';
$password = '123';
$database = "voyagefacile1";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch bus data from highwaybusAdd table including date
$sql = "SELECT id, highway_bus_name, ticket_price, DATE_FORMAT(date, '%Y-%m-%d') AS departing_date FROM highwaybusAdd";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch data and store in an array
    $busData = array();
    while ($row = $result->fetch_assoc()) {
        $busData[] = $row;
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
