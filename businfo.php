<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Second Page</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
       .banner-image {
            width: 100%;
            height: auto;
        }
        .bus-icon {
            width: 50px; 
            height: 50px;
            margin-right: 10px;
        }
        .travelling-aid {
            font-size: 2em; 
            font-weight: bold;
        }
        .card {
            height: 100%; /* Adjust height as needed */
        }
  </style>
</head>
<body>

<!-- Banner -->
<img src="bbb.png" alt="Banner Image" class="banner-image">

<div class="container mt-5">
    <h3>Check out Voyage Facile Highway Bus </h3>

    <div class="row mt-3">
        
        <!-- PHP code to dynamically generate package rectangles -->
        <?php
// Database connection
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

// Fetch data from database
$sql = "SELECT * FROM highwaybusAdd";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-6 mb-4"> <!-- Adjust column width here -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Highway Bus Name: ' . $row["highway_bus_name"] . '</h5>
                        <p class="card-text">Date: ' . $row["date"] . '<br>Highway Bus Number: ' . $row["highway_bus_number"] . '<br>Departing Time: ' . $row["departing_time"] . '<br>Arriving Time: ' . $row["arriving_time"] . '<br>Time Duration: ' . $row["time_duration"] . '<br>Ticket Price: Rs.' . $row["ticket_price"] . '<br>Number of Seats: ' . $row["number_of_seats"] . '<br>Contact Number: ' . $row["contact_number"] . '</p>
                    </div>
                </div>
              </div>';
    }
} else {
    echo "0 results";
}
$conn->close();
?>

        <!-- End of PHP code -->
    </div>  
</div>
<!-- Order  Button -->
<div class="container mt-5">
    <a href="ticketReserve.html" class="btn btn-primary">Reserve Tickets</a>
</div>
</body>
</html>

