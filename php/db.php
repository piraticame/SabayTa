<?php
$servername = "localhost";
$name = "root";
$password = "";

$conn = new mysqli($servername, $name, $password);


$sql = "CREATE DATABASE IF NOT EXISTS sabaytadb";


if ($conn->query($sql) === TRUE) {
}
$select = mysqli_select_db($conn, "sabaytadb");

//create tables
$sql2 = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL,
    firstname VARCHAR(30) NULL,
    middlename VARCHAR(30) NULL,
    lastname VARCHAR(30) NULL,
    gender VARCHAR(30) NULL,
    phone VARCHAR(30) NULL,
    birthdate DATE NULL,
    profile VARCHAR(30) NULL,

    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
if ($conn->query($sql2) === TRUE) {
}
// $sql3 = "CREATE TABLE IF NOT EXISTS uploads (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(30) NOT NULL,
//     title VARCHAR(30) NOT NULL,
//     description VARCHAR(30) NULL,
//     category VARCHAR(30) NULL,
//     file VARCHAR(30) NULL,
//     reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//     )";
?>