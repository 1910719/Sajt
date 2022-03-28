<?php
session_start();
    $email = $_POST["email"];
    $sifra = $_POST["sifra"];
    
    if (empty(trim($email)) || empty(trim($sifra))) {
        echo "greska";
        return;
    }

    $connection = napravi_konekciju();
    if (vec_postoji($connection, $email, $sifra)) {
        echo "taj nalog vec postoji";
        return;
    }

    napravi_nalog($connection, $email, $sifra);

    $connection->close();

    function vec_postoji(?mysqli $connection, ?string $email, ?string $sifra) {
        $query = "SELECT * FROM nalozi WHERE (email = '$email')";
        $result = $connection->query($query);
        return $result->num_rows > 0;
    }

    function napravi_nalog(?mysqli $connection, ?string $email, ?string $sifra) {
        $query = "INSERT INTO nalozi VALUES ('$email', '$sifra')";
        if ($connection->query($query) === TRUE) {
            print "nalog napravljen";
            $_SESSION["ulogovan"] = false;
            header('Refresh: 2; url=/index.php');
        } else {
            echo "greska";
        }
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