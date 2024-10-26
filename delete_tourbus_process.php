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

// Retrieve package name from the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $packageName = $_POST["packageName"];

    // Prepare SQL statement to delete the record based on package name
    $sql = "DELETE FROM tourpackages WHERE PackageName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $packageName);

    // Execute the delete statement
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
