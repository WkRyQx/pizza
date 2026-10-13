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
    <title>Termékek Admin</title>
</head>
<body>
    <h1>Termékek</h1>

    <p>Termékek szerkesztése</p>
    
    <?php
    // Lekérdezzük az összes terméket az adatbázisból
    $sql = "SELECT * FROM termekek";
    $result = $conn->query($sql);
    ?>

</body>
</html>