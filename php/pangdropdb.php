<?php
$servername = "localhost";
$name = "root";
$password = "";
$dbname = "sabaytadb";

$conn = new mysqli($servername, $name, $password, $dbname);
//drop database
$sql = "DROP DATABASE sabaytadb";
if ($conn->query($sql) === TRUE) {
    echo "Database dropped successfully";
} else {
    echo "Error dropping database: " . $conn->error;
}
