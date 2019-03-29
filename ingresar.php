<?php

    include("conexion.php");
    $dui = $_POST['dui'];
    $contrsea = $_POST['contrasea'];
    
    $query = "SELECT * FROM Usuarios WHERE Dui ='".$dui."'";
    $resultSelectByID = mysqli_query($conexion, $query); 
    $row = mysqli_fetch_array($resultSelectByID);

    if ($row != null){
        if ($contrsea == $row['Contrasea']){
            session_start();
            $_SESSION['user'] = $row['Dui'];
            $_SESSION['rol'] = $row['Cargo'];
            $_SESSION['estado'] = "activa";
            header("Location: index.php");
        } else {
            header("Location: login.php");
        }    
    }else {
        header("Location: login.php");
    }
?>