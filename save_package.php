<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $db_host = 'localhost';
    $db_user = 'dseuser';
    $db_password = '123';
    $db_db = 'voyagefacile1';

    $conn = new mysqli($db_host, $db_user, $db_password, $db_db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO tourpackages (PackageNumber, PackageName, PackageDestination, PackagePrice, PackageDuration, Travellers, ContactNumber) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssis", $packageNumber, $packageName, $packageDestination, $packagePrice, $packageDuration, $packagetravellers, $contactNumber);

    // Set parameters from the form
    $packageNumber = $_POST['packageNumber'];
    $packageName = $_POST['packageName'];
    $packageDestination = $_POST['packageDestination'];
    $packagePrice = $_POST['packagePrice'];
    $packageDuration = $_POST['packageDuration'];
    $packagetravellers = $_POST['packagetravellers'];
    $contactNumber = $_POST['contactNumber'];

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "New record created successfully";
        header("Location: adminaddTour.html");
    exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
