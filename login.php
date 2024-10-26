<?php

session_start();


$servername = "localhost";
$username = 'dseuser';
$password = '123';
$database = "voyagefacile1";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$currentDate = date("Y-m-d");


$sql = "DELETE FROM highwaybusadd WHERE date < ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $currentDate);
$stmt->execute();
$stmt->close();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

   
    $sql = "SELECT id, username, password FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
  
        if (password_verify($password, $row["password"])) {
          
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            header("Location: businfo.php");
            exit;
        } else {
           
            echo "<script>alert('Incorrect password');</script>";
        }
    } else {
  
        echo "<script>alert('User not found');</script>";
    }
}


$conn->close();
?>
