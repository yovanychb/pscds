<?php
    $Server = '127.0.0.1';
    $Usuario = 'root';
    $contra = '12345';
    $Namebd = 'PSCDS';
    $conexion = new mysqli($Server, $Usuario, $contra, $Namebd);
    
    if ($conexion ->connect_error) {
        die("error de conexion".$conexion ->connect_error);
    }
?>