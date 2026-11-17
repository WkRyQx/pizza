<?php
session_start();

if (!isset($_SESSION['user_szerepkor'])) {
    header("Location: login.php");
    exit();
}

 Ellenőrizzük, hogy a felhasználó admin-e
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

//=========================Felhasználók lekérdezése=========================
$sql = "SELECT * FROM felhasznaló";
$result = $conn->query($sql);

//=========================Felhasználók szerkesztes=========================




//=========================Felhasználók torlese=========================



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felhasználó Admin</title>
</head>
<body>
    <h1>Felhasználók:</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Felhasználónév</th><th>Email</th><th>Szerepkör</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['felhasznalonev'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['szerepkor'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nincs felhasználó az adatbázisban.";
    }
    ?>
</body>
</html>