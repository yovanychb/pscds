<?php
    session_start();

    if ($_SESSION['estado'] != "activa"){
        header("Location: login.php");
    }
?>