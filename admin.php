<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
        <h1>Admin Panel</h1>
        <ul>
            <li><a href="termekek.php">Termékek kezelése</a></li>
            <li><a href="rendelesek.php">Rendelések kezelése</a></li>
            <li><a href="kuponok.php">Kuponok kezelése</a></li>
            <li><a href="felhasznalok.php">Felhasználók kezelése</a></li>                           
        </ul>
        <a href="kijelentkezes.php">Kijelentkezés</a>
</body>
</html>