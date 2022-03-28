<?php
    session_start();
    $_SESSION["ulogovan"] = false;
    print "izlogovali ste se";
    header('Refresh: 2; url=/index.php');
?>