<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zmijica</title>
    <style>

    </style>
</head>
<body>
    <canvas id="canvas" width="600" height="600"/>
    <?php
        if (!ulogovan()) {
            print "nisi ulogovan";
            return;
        }

        function ulogovan() {
            if (!isset($_SESSION["ulogovan"])) return false;
            return $_SESSION["ulogovan"];
        }
    ?>
    <script type="text/javascript" src="igrice/zmijica.js"> </script>
</body>
</html>