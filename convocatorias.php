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
            $id = "";
            $titulo = "";
            $inicio = "";
            $fin = "";
            $cantidad = "";
            $curso = "";
            $add = true;

        if (isset($_GET['select'])){
            $id = $_GET['select'];
            $query = "SELECT * FROM Convocatorias WHERE Id_Convocatorias=".$id."";
            $resultSelectByID = mysqli_query($conexion, $query); 
            $row = mysqli_fetch_array($resultSelectByID);
            $id = $row['Id_Convocatorias'];
            $titulo = $row['Titulo'];
            $inicio = $row['Fecha_Inicio'];
            $fin = $row['Fecha_Fin'];
            $cantidad = $row['Cantidad'];
            $curso = $row['Id_Curso'];
            $add = false;
        }

        $consulta = "SELECT * FROM Cursos";
        $result = $conexion -> query($consulta);

        
        echo '<form method="post" >
        <div id="form">
            <label for="curso">Curso</label>
            <select name="curso" id="curso">
            <option value="">Seleccione un curso</option>';
            while ($registro = $result -> fetch_assoc()){
                if ($registro['Id_Curso'] == $curso){
                    echo '<option value="'.$registro['Id_Curso'].'" selected>'.$registro['Nombre'].'</option>';
                } else {
                    echo '<option value="'.$registro['Id_Curso'].'">'.$registro['Nombre'].'</option>';
                }
            }

        echo '</select><br><br>
                <label for="nombre">Id</label>
                <input type="text" name="id" id="id" value="'.$id.'" class="btn btn-outline-info"> <br><br>
                <label for="nombre">Titulo</label>
                <input type="text" name="titulo" id="titulo" value="'.$titulo.'"class="btn btn-outline-info"> <br><br>
                <label for="nombre">Fecha de inicio</label>
                <input type="date" name="inicio" id="inicio" value="'.$inicio.'" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"><br><br>
                <label for="nombre">Fecha de fin</label>
                <input type="date" name="fin" id="fin" value="'.$fin.'" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"><br><br>
                <label for="nombre">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" value="'.$cantidad.'"><br><br>';
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
                        <th>Numero</th>
                        <th>Titulo</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Cantidad de aprobados</th>
                        <th>Curso</th>
                        <th>Accion</th>
                        </tr>';
                        
            $consulta = "SELECT * FROM Convocatorias";

            $result = $conexion -> query($consulta);

            while ($registro = $result -> fetch_assoc()){
                echo '<tr>
                    <td>'.$registro['Id_Convocatorias'].'</td>
                    <td>'.$registro['Titulo'].'</td>
                    <td>'.$registro['Fecha_Inicio'].'</td>
                    <td>'.$registro['Fecha_Fin'].'</td>
                    <td>'.$registro['Cantidad'].'</td>
                    <td>'.$registro['Id_Curso'].'</td>
                    <td>
                        <a href="convocatorias.php?select='.$registro['Id_Convocatorias'].'">Seleccionar</a>
                </td></tr>';
            }
            echo '</table></div></form>';

            if (isset($_POST['add'])) {
                $id = getValue($_POST['id']);
                $titulo = getValue($_POST['titulo']);
                $inicio = getValue($_POST['inicio']);
                $fin = getValue($_POST['fin']);
                $cantidad = getValue($_POST['cantidad']);
                $curso = getValue($_POST['curso']);
                $consulta = "INSERT INTO Convocatorias (`Id_Convocatorias`,`Titulo`, `Fecha_Inicio`, `Fecha_Fin`, `Cantidad` , `Id_Curso`) 
                VALUES('".$id."','".$titulo."','".$inicio."','".$fin."','".$cantidad."','".$curso."')";
                $result = $conexion -> query($consulta);
                echo '<script> 
                alert("agregado con exito");
                window.location.href="convocatorias.php";
                </script>';    
            }

            if (isset($_POST['edit'])) {
                $id = getValue($_POST['id']);
                $titulo = getValue($_POST['titulo']);
                $inicio = getValue($_POST['inicio']);
                $fin = getValue($_POST['fin']);
                $cantidad = getValue($_POST['cantidad']);
                $curso = getValue($_POST['curso']);
                $consulta = "UPDATE Convocatorias SET Titulo = '".$titulo."', Fecha_Inicio = '".$inicio."', 
                Fecha_Fin = '".$fin."', Cantidad = '".$cantidad."', Id_Curso = '".$curso."' WHERE Id_Convocatorias = ".$id.";";
                $result = $conexion -> query($consulta);
                echo '<script> 
                alert("agregado con exito");
                window.location.href="convocatorias.php";
                </script>';    
            }

            if (isset($_POST['delete'])){
                $id = $_POST['id'];
                $query = "DELETE FROM Convocatorias WHERE Id_Convocatorias='".$id."'";
                $result = $conexion -> query($query);
                echo '<script type="text/javascript">
                alert("Usuario eliminado con Exito");
                window.location.href="convocatorias.php";
                </script>';
            }

            if (isset($_POST['cancel'])){            
                echo '<script type="text/javascript">
                window.location.href="convocatorias.php";
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