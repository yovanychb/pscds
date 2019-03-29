<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seleccion CDS</title>
</head>
<body>
<?php
    require_once("inicio.php");
    if ($_SESSION['rol']== "A"){
        echo "<h1>Entro como Administrador</h1>";
    }if ($_SESSION['rol']== "P"){
        echo "<h1>Entro como Profesor</h1>";
    }
?>
</body>
</html>
