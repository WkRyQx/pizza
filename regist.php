<?php
/* =========================SESSION + DB (MYSQLI)========================= */
session_start();

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

/* =========================Regisztráció========================= */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $nev = trim($_POST["nev"] ?? "");
    $jelszo = $_POST["jelszo"] ?? "";

    if ($email === "" || $nev === "" || $jelszo === "") {
        $error = "Minden mezőt ki kell tölteni.";
    } else {

        $hash = password_hash($jelszo, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO felhasznaló
        (email, nev, jelszo, szallitasicim, pontok, kuponok, reg_datum, szerpkor_id)
        VALUES (?, ?, ?, '', 0, '', NOW(), 1)");

        if ($stmt) {
            $stmt->bind_param("sss", $email, $nev, $hash);

            if ($stmt->execute()) {
                $success = "Sikeres regisztráció!";
            } else {
                $error = "Hiba a regisztrációnál.";
            }

            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="regist.css">
</head>


<div>
    <span class="paprika-badge">PAPRIKA KLUB</span>
    <br>
    <h1>Pontok,kuponok, több pizza</h1>
    
    <br>
    <ul style="list-style-type: none; padding-left: 0;">
        <li>&#10003; Hűségpont minden vásárlás után</li>
        <li>&#10003; 5%, 10% és 15% kuponokra váltható</li>
        <li>&#10003; Szerencsekerék exkluzív nyereményekkel</li>
    </ul>
</div>


 
<body>
    <div class="login-box">
        <div class="login-header">
            <h2>Fiók létrehozása</h2>
        </div>


        <form method="POST" action="">
            <div class="input-box">
                <input type="text" name="nev" class="input-field" placeholder="Név" autocomplete="off" required>
            </div>

            <div class="input-box">
                <input type="email" name="email" class="input-field" placeholder="Email" autocomplete="off" required>
            </div>

            <div class="input-box">
                <input type="password" name="jelszo" id="jelszo" class="input-field" placeholder="Jelszó" autocomplete="off" required>
                <i class="fa-sharp fa-solid fa-eye-slash"></i>
            </div>

            <div class="input-box">
                <input type="password" name="jelszo_confirm" class="input-field" placeholder="Jelszó megerősít" autocomplete="off" required>
                <i class="fa-sharp fa-solid fa-eye-slash"></i>
            </div>

            <p id="jelszo-warning" style="color:red; display:none;">
                A jelszónak legalább 8 karakter hosszúnak kell lennie!
            </p>

            <div class="input-submit">
                <button type="submit" class="submit-btn" id="submit"></button>
                <label for="submit">Regisztráció</label>
            </div>

            <div class="sign-up-link">
                <p>Már van fiókod? <a href="login.php">Bejelentkezés</a></p>
            </div>
        </form>
    </div>

    <script>
        const jelszoInput = document.getElementById('jelszo');
        const jelszoWarning = document.getElementById('jelszo-warning');
        const formElement = document.querySelector('form');

        jelszoInput.addEventListener('input', function() {
            if (this.value.length < 8 && this.value.length > 0) {
                jelszoWarning.style.display = 'block';
            } else {
                jelszoWarning.style.display = 'none';
            }
        });

        formElement.addEventListener('submit', function(e) {
            if (jelszoInput.value.length < 8) {
                e.preventDefault();
                jelszoWarning.style.display = 'block';
                jelszoInput.focus();
            }
        });
    </script>
</body>

</html>