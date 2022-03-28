<?php
session_start();
$_SESSION["ulogovan"] = false;
$email = $_POST["email"];
$sifra = $_POST["sifra"];
$connection = napravi_konekciju();
if (nalog_postoji($connection, $email, $sifra)) {
    // uloguj
    echo "ulogovao si se";
    $_SESSION["ulogovan"] = true;
    header('Refresh: 2; url=/igrice.php');
} else {
    echo "pogresna sifra ili email";
}
$connection->close();

function nalog_postoji(?mysqli $connection, ?string $email, ?string $sifra) {
    if (empty(trim($email)) || empty(trim($sifra))) return false;
    $query = "SELECT * FROM nalozi WHERE (email = '$email' AND sifra = '$sifra')";
    $result = $connection->query($query);
    return $result->num_rows > 0;
}

function ulogovan() {
    if (!isset($_SESSION["ulogovan"])) return false;
    return $_SESSION["ulogovan"];
}

function napravi_konekciju() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";
    
    // Create connection
    $conn = new mysqli($servername, 
        $username, $password, $dbname);
      
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " 
            . $conn->connect_error);
    }
    return $conn;
}

function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}
?>