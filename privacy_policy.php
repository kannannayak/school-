<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "u892124399_mithra";
$password = "u892124399_Mithra";  // Make sure to use the correct password
$dbname = "u892124399_mithra";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve privacy policy from the database
$sql = "SELECT privacy FROM info WHERE info_id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . $row["privacy"] . "</p>";
    }
} else {
    echo "Privacy policy not found.";
}

$conn->close();
?>
