<?php
// Establish database connection
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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $busName = $conn->real_escape_string($_POST['busRoute']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);
    $seatsAvailable = $conn->real_escape_string($_POST['seatsAvailable']);

    // Debugging: Echo out the bus name received from the form
    echo "Bus name received from form: " . $busName . "<br>";

    // Get B_id from highwaybusAdd table based on Bus_name
    $query = "SELECT id FROM highwaybusAdd WHERE highway_bus_name = '$busName'";
    $result = $conn->query($query);

    // Debugging: Echo out the number of rows returned by the query
    echo "Number of rows returned by the query: " . $result->num_rows . "<br>";

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $B_id = $row["id"];

        // Insert data into Shifts table
        $sql = "INSERT INTO Shifts (Bus_name, Date, Time, Number_of_Seats_Available, B_id) 
                VALUES ('$busName', '$date', '$time', '$seatsAvailable', '$B_id')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Bus not found in the database";
    }
}

// Close connection
$conn->close();
?>
