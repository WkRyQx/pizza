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
                    if($szerepkor==2){
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
