<?php
session_start();

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

// Retrieve user ID from session
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Retrieve bus name and date from the POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $busName = $_POST["busName"];
        $date = $_POST["date"];

        // Prepare SQL statement to fetch reservation details
        $sql = "SELECT `Bus_name`, `Date`, `Number_of_seats`, `Payment` FROM `Reservations` WHERE `Bus_name` = ? AND `Date` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss",  $busName, $date);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Display reservation details in a table
            echo "<table class='table'>";
            echo "<thead><tr><th>Bus Name</th><th>Date</th><th>Number of Seats</th><th>Payment</th></tr></thead><tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Bus_name"] . "</td><td>" . $row["Date"] . "</td><td>" . $row["Number_of_seats"] . "</td><td>" . $row["Payment"] . "</td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "No reservations found.";
        }
    }
} else {
    echo "User ID not found in session.";
}

$conn->close();
?>
