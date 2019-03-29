<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios</title>
    
</head>
<body>

    <?php
    require_once("inicio.php");
    if ($_SESSION['rol'] == "A"){
        $nombre = "";
        $apellido = "";
        $dui = "";
        $cargo = "";
        $telefono = "";
        $correo = "";
        $foto = "";
        $contrasena = "";
        $add = true;

        if (isset($_GET['select'])){
            $id = $_GET['select'];
            $query = "SELECT * FROM Usuarios WHERE Dui='".$id."'";
            $resultSelectByID = mysqli_query($conexion, $query); 
    
            $row = mysqli_fetch_array($resultSelectByID);
            
            $nombre = $row['Nombres'];
            $apellido = $row['Apellidos'];
            $dui = $row['Dui'];
            $cargo = $row['Cargo'];
            $telefono = $row['Telefono'];
            $correo = $row['Correo'];
            $foto = $row['Imagen'];
            $contrasena = $row['Contrasea'];
            header("usuarios.php");
            $add = false;
        }
        
        echo '<form method="post" >
                <div id="form">
                    <label for="nombre">DUI</label>
                    <input type="text" name="dui" id="dui" value="'.$dui.'"><br><br>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="'.$nombre.'"> <br><br>
                    <label for="nombre">Apellido</label>
                    <input type="text" name="apellido" id="apellido" value="'.$apellido.'"><br><br>
                    <label for="nombre">Cargo</label>
                    <input type="text" name="cargo" id="cargo" value="'.$cargo.'"><br><br>
                    <label for="nombre">Telefono</label>
                    <input type="text" name="telefono" id="telefono" value="'.$telefono.'"><br><br>
                    <label for="nombre">Correo</label>
                    <input type="text" name="correo" id="correo" value="'.$correo.'"><br><br>
                    <label for="nombre">Contrseña</label>
                    <input type="password" name="contrasena" id="contrasena" value="'.$contrasena.'"><br><br>
                    <label for="nombre">Foto</label>
                    <input type="text" name="foto" id="foto" value="'.$foto.'"><br><br>';
                    if ($add){
                        echo '<input type="submit" value="AGREGAR" name="add">';
                    } else {
                    echo '<input type="submit" value="EDITAR" name="edit">
                    <input type="submit" value="ELIMINAR" name="delete">';
                    }
                    echo '<input type="submit" value="CANCELAR" name="cancel">
                </div><br>            
            </form>';
            

            $consulta = "SELECT * FROM Usuarios";
            
            $result = $conexion -> query($consulta);
            echo '<form method="post" ><div id="tabla"><table>
            <tr>
                <th>DUI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cargo</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Imagen</th>
            </tr>';

            while ($registro = $result -> fetch_assoc()){
                echo '<tr>
                <td>'.$registro['Dui'].'</td>
                <td>'.$registro['Nombres'].'</td>
                <td>'.$registro['Apellidos'].'</td>
                <td>'.$registro['Cargo'].'</td>
                <td>'.$registro['Telefono'].'</td>
                <td>'.$registro['Correo'].'</td>
                <td>'.$registro['Imagen'].'</td>
                <td></h1>
                    <a href="usuarios.php?select='.$registro['Dui'].'">Seleccionar</a>
                </td></tr>';

            }
            echo '</table> </div> </form>';

            if (isset($_POST['add'])) {
                $nombre = getValue($_POST['nombre']);
                $apellido = getValue($_POST['apellido']);
                $dui = getValue($_POST['dui']);
                $cargo = getValue($_POST['cargo']);
                $telefono = getValue($_POST['telefono']);
                $correo = getValue($_POST['correo']);
                $foto = getValue($_POST['foto']);
                $contrasena = getValue($_POST['contrasena']);

                $consulta = "INSERT INTO Usuarios (`Dui`, `Imagen`, `Nombres`, `Apellidos`, `Telefono`, `Cargo`, `Correo`, `Contrasea`) 
                VALUES('".$dui."','".$foto."','".$nombre."','".$apellido."','".$telefono."','".$cargo."','".$correo."','".$contrasena."')";

                $result = $conexion -> query($consulta);
                echo '<script> 
                alert("agregado con exito");
                window.location.href=usuarios.php";
                </script>'; 
            }

            if (isset($_POST['edit'])) {
                $nombre = getValue($_POST['nombre']);
                $apellido = getValue($_POST['apellido']);
                $dui = getValue($_POST['dui']);
                $cargo = getValue($_POST['cargo']);
                $telefono = getValue($_POST['telefono']);
                $correo = getValue($_POST['correo']);
                $foto = getValue($_POST['foto']);
                $contrasena = getValue($_POST['contrasena']);

                $consulta = "UPDATE Usuarios SET Nombres = '".$nombre."', Apellidos = '".$apellido."', Telefono = '".$telefono."', 
                Cargo = '".getValue($cargo)."', Correo = '".$correo."', Contrasea = '".$contrasena."' WHERE Dui = '".$dui."';";
                
                if($conexion->query($consulta)==true){
                echo'<script type="text/javascript">
                alert("Registro Actualizado con Exito");
                window.location.href="usuarios.php";
                </script>';               
                }else{
                echo'<script type="text/javascript">
                alert("Registro No Actualizado ");
                window.location.href="usuarios.php";
                </script>';
                
                }
            }

            if (isset($_POST['delete'])){
                $id = $_POST['dui'];
                $query = "DELETE FROM Usuarios WHERE Dui='".$id."'";
                $result = $conexion -> query($query);
                echo '<script type="text/javascript">
                alert("Usuario eliminado con Exito");
                window.location.href="usuarios.php";
                </script>';
            }

            if (isset($_POST['cancel'])){            
                echo '<script type="text/javascript">
                window.location.href="usuarios.php";
                </script>';
            }

            function getValue($strvar) {
                $banned = array("select","SELECT","<","=",">","drop","DROP","--","|","insert","INSERT","delete","DELETE","'","xp_");
                $vowels =$banned;
                $no =str_replace($vowels,"",$strvar);
                $final=str_replace("'","",$no);
                return $final;  
            }
        }else{
            header("location: index.php");
        }
    ?>
    
</body>
</html>