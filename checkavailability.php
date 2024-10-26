<?php
// Database connection parameters
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

// Retrieve form data and sanitize
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the bus_select field is empty
    if (empty($_POST["busSelect"])) {
        echo "Bus selection is required";
    } else {
        $bus_select = $_POST["busSelect"];
        $date = $_POST["date"];
        $formatted_date = date("Y-m-d"); // Format date string to YYYY-MM-DD format

        // SQL to check seat availability for the selected bus and date
        $sql = "SELECT seat_numbers FROM reservations WHERE bus_select = ? AND date = ?";
        
        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $bus_select, $formatted_date);

        // Execute SQL query
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there are reserved seats
        if ($result->num_rows > 0) {
            // Display reserved seats
            echo "<h2>Reserved Seats for $bus_select on $formatted_date:</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Reserved Seat Numbers</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["seat_numbers"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            // If no seats are reserved
            echo "<h2>No seats reserved for $bus_select on $formatted_date</h2>";
        }

        // Close statement and result set
        $stmt->close();
        $result->close();
    }
}

// Close database connection
$conn->close();
?>
