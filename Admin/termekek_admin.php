<?php
session_start();

if (!isset($_SESSION['user_szerepkor'])) {
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
    //összes terméket az adatbázisból
    $sql = "SELECT * FROM termék";
    $result = $conn->query($sql);

    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Név</th><th>Leírás</th><th>Ár</th><th>Műveletek</th></tr>";
    if ($result->num_rows > 0) {    
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['termek_id'] . "</td>";
            echo "<td>" . $row['termek_nev'] . "</td>";
            echo "<td>" . $row['tipus'] . "</td>";
            echo "<td>" . $row['ar'] . "</td>";
            echo "<td><a href='termek_szerkeszt.php?id=" . $row['termek_id'] . "'>Szerkesztés</a> | <a href='termek_torles.php?id=" . $row['termek_id'] . "'>Törlés</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Nincs termék az adatbázisban.</td></tr>";
    }
    echo "</table>";
    ?>
</body>
</html>