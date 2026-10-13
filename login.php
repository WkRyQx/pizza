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

/* =========================Bejelentkezés-Regisztráció========================= */
if($_SERVER["REQUEST_METHOD"]==="POST"){ $action=$_POST["action"] ?? ""; if($action==="register"){ 
    $email=trim($_POST["email"] ?? ""); $nev=trim($_POST["nev"] ?? ""); 
    $jelszo=$_POST["jelszo"] ?? ""; 
    if($email==="" || $nev==="" || $jelszo===""){ 
        $error="Minden mezőt ki kell tölteni."; 
    }else{ 
        $hash=password_hash($jelszo,PASSWORD_DEFAULT); 
        $stmt=$conn->prepare("INSERT INTO felhasznaló(email,nev,jelszo,szallitasicim , pontok , kuponok, reg_datum,szerpkor_id) VALUES(?,?,?,'',0,'',NOW(),2)"); 
        if($stmt){ $stmt->bind_param("sss",$email,$nev,$hash); 
        if($stmt->execute()){ 
            $success="Sikeres regisztráció!"; 
        }else{ 
            $error="Hiba a regisztrációnál."; 
        } 
        $stmt->close(); } } } if($action==="login"){ $email=trim($_POST["emaillog"] ?? ""); 
        $jelszo=$_POST["jelszolog"] ?? ""; 
        if($email==="" || $jelszo===""){ 
            $error="Add meg az emailt és a jelszót.";
        }else{ 
            $stmt=$conn->prepare("SELECT id,email,jelszo,nev,szallitasicim , pontok , kuponok,szerpkor_id FROM felhasznaló WHERE email=?"); 
            if($stmt){ $stmt->bind_param("s",$email); 
            $stmt->execute(); $stmt->store_result(); 
            if($stmt->num_rows===1){ 
                $stmt->bind_result($id,$db_email,$hash,$nev ,$szallitasicim , $pontok , $kuponok, $szerepkor); 
                $stmt->fetch(); 
                if(password_verify($jelszo,$hash)){ 
                    session_regenerate_id(true); 
                    $_SESSION["user_id"]=$id; 
                    $_SESSION["user_name"]=$nev; 
                    $_SESSION["user_email"]=$db_email; 
					$_SESSION["user_szallitasicim"]=$szallitasicim; 
                    $_SESSION["user_pontok"]=$pontok; 
                    $_SESSION["user_kuponok"]=$kuponok; 
                    $_SESSION["user_szerepkor"]=$szerepkor; 
                    if($szerepkor==1){
                         header("Location: kezdolap.php"); 
                    }else{ 
                        header("Location: admin.php"); 
                    } exit; }
                    else{
                         $error="Hibás email vagy jelszó."; 
                    } }else{ 
                        $error="Hibás email vagy jelszó."; 
                        } 
                        $stmt->close(); 
                        } 
                    }
                }
            } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-box">
            
        <div class="login-header">
            <h1><span>Üdv újra!</span> <span style="color: #ca661f;" href="">Lépj be fiókodba.</span></h1>
        </div>

        

        <form method="POST">

            <div class="input-box">
                Email
                <input type="email" name="email" class="input-field" placeholder="nev@email.com" autocomplete="off" required>
            </div>

            <div class="input-box">
                Jelszó
                <input type="password" name="password" class="input-field" placeholder="******" autocomplete="off" required>
                <i class="fa-sharp fa-solid fa-eye-slash"></i>
            </div>

            <div class="input-submit">
                <button type="submit" class="submit-btn" id="submit"></button>
                <label for="submit">Bejelentkezés</label>
            </div>

            <div class="sign-up-link">
                <p >  Még nincs fiókod? <a style="color: #ca661f ;" href="regist.php">Regisztrálj most</a></p>
            </div>

        </form>
    </div>
    <div class="pizzaimg">
                <img src="pizza.png">
            </div>
</body>
</html>





