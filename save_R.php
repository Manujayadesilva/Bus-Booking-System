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

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busRouteId = $_POST["busRoute"]; // ID of the selected bus route
    $date = $_POST["date"];
    $numberOfSeats = $_POST["priority"];
    $total = $_POST["totalPrice"];

    // Get current user's ID from the Users table
    session_start();
    $currentUser = $_SESSION["user_id"];

    // Fetch the bus name and available seats based on the selected ID
    $fetchBusInfoSql = "SELECT highway_bus_name, number_of_seats FROM highwaybusAdd WHERE id = ?";
    $stmt = $conn->prepare($fetchBusInfoSql);
    $stmt->bind_param("i", $busRouteId);
    $stmt->execute();
    $result = $stmt->get_result();
    $busInfo = $result->fetch_assoc();

    // Check if user ID is retrieved successfully
    if (!$currentUser) {
        echo "User ID not found.";
    } else {
        // Check if there are enough available seats
        $availableSeats = $busInfo["number_of_seats"];
        if ($availableSeats >= $numberOfSeats) {
            // Proceed to reservation insertion
            $busName = $busInfo["highway_bus_name"];
            $sql = "INSERT INTO Reservations (Bus_name, Date, Number_of_seats, Payment, U_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssiii", $busName, $date, $numberOfSeats, $total, $currentUser);

            if ($stmt->execute()) {
                // Reservation saved successfully. Now update the number of seats in the highwaybusadd table
                $updateSql = "UPDATE highwaybusadd SET number_of_seats = number_of_seats - ? WHERE id = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("ii", $numberOfSeats, $busRouteId);
                $updateStmt->execute();

                header("Location: payment.php");
    exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close statements
            $stmt->close();
            $updateStmt->close();
        } else {
            // Fetch remaining available seats
            $remainingSeatsSql = "SELECT number_of_seats FROM highwaybusAdd WHERE id = ?";
            $stmt = $conn->prepare($remainingSeatsSql);
            $stmt->bind_param("i", $busRouteId);
            $stmt->execute();
            $result = $stmt->get_result();
            $remainingSeats = $result->fetch_assoc()["number_of_seats"];

            echo "Error: Cannot book. Only " . $remainingSeats . " seats are available.";
        }
    }
}

// Close connection
$conn->close();
?>
