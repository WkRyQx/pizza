<?php
session_start();

// Ellenőrizzük, hogy a felhasználó admin-e
if (!isset($_SESSION['user_szerepkor']) || $_SESSION['user_szerepkor'] != 2) {
    header("Location: kezdolap.php");
    exit();
}

//=========================SESSION + DB (MYSQLI)=========================

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizzazo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Hiba a kapcsolódáskor: " . $conn->connect_error);
}
$success = "";
$error = "";
?>