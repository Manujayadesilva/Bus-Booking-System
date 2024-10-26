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
        // Ensure that the date is in YYYY-MM-DD format
        $formatted_date = date("Y-m-d"); // Format date string to YYYY-MM-DD format

        $number_of_tickets = $_POST["numberOfTickets"];
        $seat_numbers = $_POST["seatNumbers"];

        // SQL to insert data into database table (use prepared statements for security)
        $sql = "INSERT INTO reservations (bus_select, date, number_of_tickets, seat_numbers)
                VALUES (?, ?, ?, ?)";
        
        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis", $bus_select, $formatted_date, $number_of_tickets, $seat_numbers);

        // Execute SQL query
        if ($stmt->execute()) {
            echo "Seats reserved successfully";
            header("Location: selectbus.html");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement
        $stmt->close();
    }
}

// Close database connection
$conn->close();
?>
