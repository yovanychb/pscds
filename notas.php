<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cursos</title>
    
</head>
<body>
    <?php
        require_once("inicio.php");
        $id = "";
        $nombre = "";
        $inicio = "";
        $fin = "";
        $cantidad = "";
        $aprobados = "";
        $add = true;

        if (isset($_GET['select'])){
            $id = $_GET['select'];
            $query = "SELECT * FROM Cursos WHERE Id_Curso='".$id."'";
            $resultSelectByID = mysqli_query($conexion, $query);      
            $row = mysqli_fetch_array($resultSelectByID);
            
            $nombre = $row['Nombre'];
            $inicio = $row['Fecha_Inicio'];
            $fin = $row['Fecha_Fin'];
            $cantidad = $row['Cantidad_Convocatorias'];
            $aprobados = $row['Cantidad_Aprobados'];
            header("cursos.php");
            $add = false;
        } 

        echo '<form method="post" >
            <div id="form">
                <input type="text" name="id" id="id" value="'.$id.'"> <br><br>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="'.$nombre.'"> <br><br>
                <label for="nombre">Fecha de inicio</label>
                <input type="date" name="inicio" id="inicio" value="'.$inicio.'" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"><br><br>
                <label for="nombre">Fecha de fin</label>
                <input type="date" name="fin" id="fin" value="'.$fin.'" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"><br><br>
                <label for="nombre">Catidad de convocatorias</label>
                <input type="number" name="cantidad" id="cantidad" value="'.$cantidad.'"><br><br>
                <label for="nombre">Cantidad de Aprobados</label>
                <input type="number" name="aprobados" id="aprobados" value="'.$aprobados.'"><br><br>';
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
                <th>Nombre</th>
                <th>Fecha de inicio</th>
                <th>Fecha de fin</th>
                <th>Catidad de convocatorias</th>
                <th>Cantidad de Aprobados</th>
                <th>Accion</th>
                </tr>';


        $consulta = "SELECT * FROM Cursos";

        $result = $conexion -> query($consulta);

        while ($registro = $result -> fetch_assoc()){
            echo '<tr>
                <td>'.$registro['Nombre'].'</td>
                <td>'.$registro['Fecha_Inicio'].'</td>
                <td>'.$registro['Fecha_Fin'].'</td>
                <td>'.$registro['Cantidad_Convocatorias'].'</td>
                <td>'.$registro['Cantidad_Aprobados'].'</td>
                <td>
                    <a href="cursos.php?select='.$registro['Id_Curso'].'">Seleccionar</a>
            </td></tr>';
        }
        echo '</table></div></form>';

        if (isset($_POST['add'])) {
            $nombre = getValue($_POST['nombre']);
            $inicio = getValue($_POST['inicio']);
            $fin = getValue($_POST['fin']);
            $cantidad = getValue($_POST['cantidad']);
            $aprobados = getValue($_POST['aprobados']);
            
            $consulta = "INSERT INTO Cursos (`Nombre`, `Fecha_Inicio`, `Fecha_Fin`, `Cantidad_Convocatorias`, `Cantidad_Aprobados`, `Id_Usuario`) 
            VALUES('".$nombre."','".$inicio."','".$fin."','".$cantidad."','".$aprobados."','".$_SESSION['user']."')";
            $result = $conexion -> query($consulta);
            echo '<script> 
            alert("agregado con exito");
            window.location.href="cursos.php";
            </script>'; 
        }

        if (isset($_POST['edit'])) {
            $id = getValue($_POST['id']);
            $nombre = getValue($_POST['nombre']);
            $inicio = getValue($_POST['inicio']);
            $fin = getValue($_POST['fin']);
            $cantidad = getValue($_POST['cantidad']);
            $aprobados = getValue($_POST['aprobados']);
            
            $consulta = "UPDATE Cursos SET Nombre = '".$nombre."', Fecha_Inicio = '".$inicio."', Fecha_Fin = '".$fin."', 
            Cantidad_Convocatorias = '".$cantidad."', Cantidad_Aprobados = '".$aprobados."', Id_Usuario = '".$_SESSION['user']."' WHERE Id_Curso = ".$id.";"; 
            $result = $conexion -> query($consulta);
            echo '<script> 
            alert("Editado con exito");
            window.location.href="cursos.php";
            </script>'; 
        }

        if (isset($_POST['delete'])){
            $id = $_POST['id'];
            $query = "DELETE FROM Cursos WHERE Id_Curso=".$id."";
            $result = $conexion -> query($query);
            echo '<script type="text/javascript">
            alert("Usuario eliminado con Exito");
            window.location.href="cursos.php";
            </script>';
        }
        
        if (isset($_POST['cancel'])){            
            echo '<script type="text/javascript">
            window.location.href="cursos.php";
            </script>';
        }

        function getValue($strvar) {
            $banned = array("select","SELECT","<","=",">","drop","DROP","--","|","insert","INSERT","delete","DELETE","'","xp_");
            $vowels =$banned;
            $no =str_replace($vowels,"",$strvar);
            $final=str_replace("'","",$no);
            return $final;  
        }
    ?>
</body>
</html>