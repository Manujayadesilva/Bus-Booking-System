<?php

$servername = "localhost";
$username = 'dseuser';
$password = '123';
$database = "voyagefacile1";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["fullName"];
    $mobile_number = $_POST["mobileNumber"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (full_name, mobile_number, username, email, password)
            VALUES ('$full_name', '$mobile_number', '$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New record created successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>
