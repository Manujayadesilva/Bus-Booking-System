<?php
// Establish connection to the database
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

// Retrieve bus name and date from the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busName = $_POST["busName"];
    $date = $_POST["date"];

    // Prepare SQL statement to delete the reservation data based on bus name and date
    $sql = "DELETE FROM Reservations WHERE Bus_name = ? AND Date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $busName, $date);

    // Execute the delete statement
    if ($stmt->execute()) {
        echo "Reservation data deleted successfully";
    } else {
        echo "Error deleting reservation data: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
