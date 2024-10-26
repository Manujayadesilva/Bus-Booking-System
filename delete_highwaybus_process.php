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

// Retrieve data from the form submission
$busName = $_POST['busName'];
$date = $_POST['date'];

// Prepare and execute the delete query
$stmt = $conn->prepare("DELETE FROM highwaybusAdd WHERE highway_bus_name = ? AND date = ?");
$stmt->bind_param("ss", $busName, $date);

if ($stmt->execute()) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close the database connection
$stmt->close();
$conn->close();
?>
