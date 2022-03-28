<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Igrice</title>
</head>
<body>
    <?php
        if (!ulogovan()) {
            echo "nisi ulogovan";
            return;
        }
        

        function ulogovan() {
            if (!isset($_SESSION["ulogovan"])) return false;
            return $_SESSION["ulogovan"];
        }
    ?>
    <a href="/zmijica.php"><img src="slike/zmijica-slika.png"></a>
</body>
</html>