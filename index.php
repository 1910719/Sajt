
<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post">
        <label for="fname">Email:</label><br>
        <input type="text" id="email" name="email" required><br>
        <label for="lname">Sifra:</label><br>
        <input type="text" id="sifra" name="sifra" required><br>
        <input type="submit" value="uloguj se">
    </form>

    <?php
        if (ulogovan()) {
            echo "<form method='get' action='/izloguj.php'><button type='submit'>Izloguj se</button></form><br><br><br>";
        }
        
        function ulogovan() {
            if (!isset($_SESSION["ulogovan"])) return false;
            return $_SESSION["ulogovan"];
        }

    ?>

    <br><br><br>
    
    <form method="get" action="/napravi_nalog.html">
        <button type="submit">Napravi nalog</button>
    </form>

    <form method="get" action="/igrice.php">
        <button type="submit">igraj igre</button>
    </form><br><br><br>
    
</body>
</html>