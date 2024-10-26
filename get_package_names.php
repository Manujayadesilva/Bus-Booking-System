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

// Fetch package names from the tourpackages table
$sql = "SELECT DISTINCT PackageName FROM tourpackages";
$result = $conn->query($sql);

// Initialize an empty array to hold the package names
$packageNames = array();

// Fetch package names and add them to the array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $packageNames[] = $row;
    }
}

// Convert the array to JSON format and output it
echo json_encode($packageNames);

// Close the database connection
$conn->close();
?>
