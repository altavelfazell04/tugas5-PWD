<?php
$servername = "localhost"; // Adjust according to your setup
$username = "root";        // Adjust according to your MySQL username
$password = "";            // Adjust if your MySQL has a password
$dbname = "peserta_seminar"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
