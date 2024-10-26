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

// Initialize variables to hold fetched data
$busName = "";
$numReservedSeats = "";
$ticketPrice = "";
$total = "";
$paymentUpdateMessage = ""; // Variable to hold payment update message

// Fetch data for Bus Name and Number of Reserved Seats from the Reservations table
$reservationsQuery = "SELECT Bus_name, Number_of_seats FROM Reservations ORDER BY R_id DESC LIMIT 1";
$reservationsResult = $conn->query($reservationsQuery);

if ($reservationsResult->num_rows > 0) {
    $reservationData = $reservationsResult->fetch_assoc();
    $busName = $reservationData['Bus_name'];
    $numReservedSeats = $reservationData['Number_of_seats'];
} else {
    // Handle case where there are no reservations
    $paymentUpdateMessage = "No reservations found";
}

// Fetch ticket price from the highwaybusAdd table based on the bus name
$ticketPriceQuery = "SELECT ticket_price FROM highwaybusAdd WHERE highway_bus_name = ?";
$stmt = $conn->prepare($ticketPriceQuery);
$stmt->bind_param("s", $busName);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $ticketPriceData = $result->fetch_assoc();
    $ticketPrice = $ticketPriceData['ticket_price'];
} else {
    // Handle case where ticket price is not found
    $paymentUpdateMessage = "Ticket price not found for the selected bus";
}

// Calculate total
$total = $numReservedSeats * $ticketPrice;

// Retrieve total from the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total = $_POST["total"];

    // Update Payment column in the Reservations table for the last row
    $updatePaymentQuery = "UPDATE Reservations SET Payment = ? ORDER BY R_id DESC LIMIT 1";
    $stmt = $conn->prepare($updatePaymentQuery);
    $stmt->bind_param("d", $total); // Assuming Payment column is of type DECIMAL
    if ($stmt->execute()) {
        $paymentUpdateMessage = "Payment updated successfully";
    } else {
        $paymentUpdateMessage = "Error updating payment: " . $conn->error;
    }
}

// Close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
        .bus-icon {
            width: 50px; 
            height: 50px;
            margin-right: 10px;
        }
        .travelling-aid {
            font-size: 2em; 
            font-weight: bold;
        }
  </style>
</head>
<body>

    <header class="navbar navbar-dark bg-dark">
        <div class="container">
             <img src="bus icon.webp" alt="Bus Icon" class="bus-icon">
             <span class="text-white travelling-aid">Voyage Facile</span>
        </div>
    </header>

  <div class="container mt-3">
    <h2>Payment</h2>
    <form action="" method="POST" id="paymentForm">
      <div class="form-group">
        <label for="busName">Bus Name:</label>
        <input type="text" class="form-control" id="busName" name="busName" value="<?php echo $busName; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="numReservedSeats">Number of Reserved Seats:</label>
        <input type="text" class="form-control" id="numReservedSeats" name="numReservedSeats" value="<?php echo $numReservedSeats; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="ticketPrice">Ticket Price:</label>
        <input type="text" class="form-control" id="ticketPrice" name="ticketPrice" value="<?php echo $ticketPrice; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="total">Total:</label>
        <input type="text" class="form-control" id="total" name="total" value="<?php echo $total; ?>" readonly>
      </div>
      <!-- Display payment update message as a pop-up -->
      <script>
        window.onload = function() {
          <?php if (!empty($paymentUpdateMessage)) : ?>
            alert("<?php echo $paymentUpdateMessage; ?>");
          <?php endif; ?>
        };
      </script>
      <button type="submit" class="btn btn-primary">Pay</button>
      <a href="ticketReserve.html" class="btn btn-secondary">Back</a>
    </form>
  </div>

</body>
</html>
