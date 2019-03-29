<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menú</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   
<!--<style>
body{
    background-image: url("./imagenes/fonddo.jpeg");
    background-size: cover;
}
</style>-->
<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    include("sesion.php");
    include("conexion.php");

    if ($_SESSION['rol']== "A"){
        echo '<ul class="navbar navbar-light" style="background-color: #e3f2fd;">
            <img src="imagenes/usa.png">
            <a href="index.php"class="btn btn-outline-info" style="font-family: century gothic;" img src="imagenes/ca.png" style="heigth: 25px; width:25px; rigth:5px; color: #00b4bd;">Inicio </a>
            <a href="usuarios.php" class="btn btn-outline-info" style="font-family: century gothic;">Usuarios</a>
            <a href="cursos.php" class="btn btn-outline-info" style="font-family: century gothic;">Cursos</a>
            <a href="convocatorias.php" class="btn btn-outline-info" style="font-family: century gothic;">Convocatorias</a>
            <a href="aspirantes.php" class="btn btn-outline-info" style="font-family: century gothic;">Aspirantes</a>
            <a href="notas.php" class="btn btn-outline-info" style="font-family: century gothic;">Notas</a>
            <a href="salir.php" class="btn btn-outline-info" style="font-family: century gothic;">salir</a>
            </ul>';

    }if ($_SESSION['rol']== "P"){
        echo '<ul class="navbar navbar-light" style="background-color: #e3f2fd;">
            <img src="imagenes/usa.png">
            <a href="index.php"class="btn btn-outline-info" style="font-family: century gothic;" img src="imagenes/ca.png" style="heigth: 25px; width:25px; rigth:5px; color: #00b4bd;">Inicio </a>
            <a href="cursos.php" class="btn btn-outline-info" style="font-family: century gothic;">Cursos</a>
            <a href="convocatorias.php" class="btn btn-outline-info" style="font-family: century gothic;">Convocatorias</a>
            <a href="aspirantes.php" class="btn btn-outline-info" style="font-family: century gothic;">Aspirantes</a>
            <a href="salir.php" class="btn btn-outline-info" style="font-family: century gothic;">salir</a>
            </ul>';
    }
    
    

    
        
        
    ?>
<img src="">
    
</body>
</html>