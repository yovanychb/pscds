
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Convocatorias</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    require_once("inicio.php");
        $nit = "";
        $nombre = "";
        $apellido = "";
        $dui = "";
        $correo = "";
        $direccion = "";
        $facebook = "";
        $tel1 = "";
        $tel2 = "";
        $telfijo = "";
        $nivel = "";
        $numero = "";
        $add = true;

    if (isset($_GET['select'])){
        $id = $_GET['select'];
        $query = "SELECT * FROM Aspirantes WHERE Nit=".$id."";
        $resultSelectByID = mysqli_query($conexion, $query); 
        $row = mysqli_fetch_array($resultSelectByID);
        $nit = $row['Nit'];
        $nombre = $row['Nombre'];
        $apellido = $row['Apellido'];
        $dui = $row['Dui'];
        $correo = $row['Correo'];
        $direccion = $row['Direccion'];
        $facebook = $row['Facebook'];
        $tel1 = $row['Telefono1'];
        $tel2 = $row['Telefono2'];
        $telfijo = $row['TelefonoFijo'];
        $nivel = $row['NivelAcademico'];
        $numero = $row['NumConvocatoria'];        
        header("aspirantes.php");
        $add = false;
        }

    echo '<form method="post" >
        <div id="form">
        <label for="nit">NIT</label>
        <input type="text" name="nit" id="nit" value="'.$nit.'"> <br><br>    
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="'.$nombre.'"> <br><br>
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido" value="'.$apellido.'"><br><br>
        <label for="dui">DUI</label>
        <input type="text" name="dui" id="dui" value="'.$dui.'"><br><br>
        <label for="correo">Correo</label>
        <input type="text" name="correo" id="correo" value="'.$correo.'"><br><br>
        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" id="direccion" value="'.$direccion.'"><br><br>
        <label for="facebook">Facebook</label>
        <input type="text" name="facebook" id="facebook" value="'.$facebook.'"><br><br>
        <label for="tel1">Telefono1</label>
        <input type="text" name="tel1" id="tel1" value="'.$tel1.'"><br><br>
        <label for="tel2">Telefono2</label>
        <input type="text" name="tel2" id="tel2" value="'.$tel2.'"><br><br>
        <label for="telfijo">Telefono Fijo</label>
        <input type="text" name="telfijo" id="telfijo" value="'.$telfijo.'"><br><br>
        <label for="nivel">Nivel Academico</label>
        <input type="text" name="nivel" id="nivel" value="'.$nivel.'"><br><br>
        <label for="numero">Numero de convocatoria</label>
        <input type="text" name="numero" id="numero" value="'.$numero.'"><br><br>';
            if ($add){
                echo '<input type="submit" value="AGREGAR" name="add">';
            } else {
            echo '<input type="submit" value="EDITAR" name="edit">
            <input type="submit" value="ELIMINAR" name="delete">';
            }
            echo '<input type="submit" value="CANCELAR" name="cancel">
            </div><br>            
         </form>';

         echo '<form method="post" ><div id="tabla"><table>
                    <tr>
                    <th>Nit</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dui</th>
                    <th>Dirección</th>
                    <th>Facebook</th>
                    <th>Telefono1</th>
                    <th>Telefono2</th>
                    <th>Telefono Fijo</th>
                    <th>Nivel Academico</th>
                    <th>Numero de convocatoria</th>
                    <th>Accion</th>
                    </tr>';
                    
        $consulta = "SELECT * FROM Aspirantes";

        $result = $conexion -> query($consulta);

        while ($registro = $result -> fetch_assoc()){
            echo '<tr>
                <td>'.$registro['Nit'].'</td>
                <td>'.$registro['Nombre'].'</td>
                <td>'.$registro['Apellido'].'</td>
                <td>'.$registro['Dui'].'</td>
                <td>'.$registro['Correo'].'</td>
                <td>'.$registro['Direccion'].'</td>
                <td>'.$registro['Facebook'].'</td>
                <td>'.$registro['Telefono1'].'</td>
                <td>'.$registro['Telefono2'].'</td>
                <td>'.$registro['TelefonoFijo'].'</td>
                <td>'.$registro['NivelAcademico'].'</td>
                <td>'.$registro['NumConvocatoria'].'</td>
                <td>
                    <a href="aspirantes.php?select='.$registro['Nit'].'">Seleccionar</a>
            </td></tr>';
        }
        echo '</table></div></form>';

        if (isset($_POST['add'])) {
            $nit = $_POST['nit'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $dui = $_POST['dui'];
            $correo = $_POST['correo'];
            $direccion = $_POST['direccion'];
            $facebook = $_POST['facebook'];
            $tel1 = $_POST['tel1'];
            $tel2 = $_POST['tel2'];
            $telfijo = $_POST['telfijo'];
            $nivel = $_POST['nivel'];
            $numero = $_POST['numero'];
            echo $inicio;
            $consulta = "INSERT INTO Aspirantes (`Nit`,`Nombre`, `Apellido`, `Dui`, `Correo` , `Direccion`, `Facebook`, `Telefono1`, `Telefono2`, `TelefonoFijo`, `Nivel_Academico`, `NumConvocatoria` ) 
            VALUES('".$id."','".$nit."','".$nombre."','".$apellido."','".$dui."','".$correo."','".$direccion."','".$facebook."','".$tel1."','".$tel2."','".$telfijo."','".$nivel."','".$numero."',2)";
            $result = $conexion -> query($consulta);
            echo '<script> 
            alert("agregado con exito");
            window.location.href="aspirantes.php";
            </script>';    
        }

        if (isset($_POST['delete'])){
            $id = $_POST['id'];
            $query = "DELETE FROM Aspirantes WHERE Nit='".$id."'";
            $result = $conexion -> query($query);
            echo '<script type="text/javascript">
            alert("Usuario eliminado con Exito");
            window.location.href="aspirantes.php";
            </script>';
        }

        if (isset($_POST['cancel'])){            
            echo '<script type="text/javascript">
            window.location.href="aspirantes.php";
            </script>';
        }
        ?>
    </form>
</body>
</html>