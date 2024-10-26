<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = 'dseuser';
    $password = '123';
    $dbname = "voyagefacile1";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the INSERT statement
    $stmt = $conn->prepare("INSERT INTO highwaybusAdd (highway_bus_number, highway_bus_name, date, departing_time, arriving_time, time_duration, ticket_price, number_of_seats, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssdsss", $highway_bus_number, $highway_bus_name, $date, $departing_time, $arriving_time, $time_duration, $ticket_price, $number_of_seats, $contact_number);

    // Set parameters and execute
    $highway_bus_number = $_POST['packageNumber'];
    $highway_bus_name = $_POST['packageName'];
    $date = $_POST['date'];
    $departing_time = $_POST['departingTime'];
    $arriving_time = $_POST['arrivingTime'];
    $time_duration = $_POST['timeDuration'];
    $ticket_price = $_POST['ticketPrice'];
    $number_of_seats = $_POST['numberOfSeats'];
    $contact_number = $_POST['contactNumber'];
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to the admin selection page after saving the package details
    header("Location: adminaddBus.html");
    exit();
}
?>
