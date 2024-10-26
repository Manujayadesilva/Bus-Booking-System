<?php
// Database connection parameters
$db_host = 'localhost';
$db_user = 'dseuser';
    $db_password = '123';
$db_db = 'voyagefacile1';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO tourpackage_order (FullName, MobileNumber, Nationality, PackageName, TravelDate, NumberOfAdults, NumberOfChildren) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssii", $fullName, $mobileNumber, $nationality, $packageName, $travelDate, $numberOfAdults, $numberOfChildren);

    // Set parameters from form data
    $fullName = $_POST['fullName'];
    $mobileNumber = $_POST['mobileNumber'];
    $nationality = $_POST['nationality'];
    $packageName = $_POST['package'];
    $travelDate = $_POST['travelDate'];
    $numberOfAdults = $_POST['numberOfAdults'];
    $numberOfChildren = $_POST['numberOfChildren'];

    // Execute the prepared statement
   if ($stmt->execute() === TRUE) {
    echo "New record inserted successfully.";
    // Redirect to package_order.html
    header("Location: packageorder.html");
    exit(); // Make sure to exit after redirection to prevent further execution
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

// Close connection
$conn->close();
?>
