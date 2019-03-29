<?php
    session_start();
    if($_SESSION['estado'] == "activa"){
        $_SESSION['estado'] == "";
        session_destroy();
    }
    header("Location: login.php");
?>