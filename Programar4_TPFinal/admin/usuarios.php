<?php
session_start();
extract($_REQUEST);
if(!isset($_SESSION['usuario_logueado']))
    header("location:usuarios.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>

<body>
    <?php require("menu.php");?>
        <h1>Usuarios</h1>
    <br>

    <?php
            if(isset($mensaje))
                print("<h3 style='color:#cc00ff'>".$mensaje."</h3>");
        ?>
    <div class="container-fluid ">
        <div class="row">
            <table class="table">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </tr>
            
                <?php
                    require("conexion.php");
                    $conexion = mysqli_connect($server_db, $usuario_db, $password_db)
                    or die("No se puede conectar con el servidor");
                    mysqli_select_db($conexion, $base_db)
                    or die("No se puede seleccionar la base de datos");
                    $instruccion="select * from usuarios  order by id_usuario";
                    $consulta=mysqli_query($conexion,$instruccion) or die("no puedo consultar");
                    $nfilas=mysqli_num_rows($consulta);
                    for($i=0;$i<$nfilas;$i++)
                    {
                        $resultado=mysqli_fetch_array($consulta);
                        print('
                        <tr>
                            <td>'.trim($resultado['nombre']).'</td>
                            <td>'.substr($resultado['apellido'],0,50).'...</td>
                            <td><a href="usuarios_editar.php?id_usuario='.$resultado['id_usuario'].'"  class="btn btn-danger">Editar</a></td>
                            <td><a href="usuarios_borrar.php?id_usuario='.$resultado['id_usuario'].'"class="btn btn-secondary">Eliminar</a></td>
                        </tr>
                        ');
                    }
                    mysqli_close($conexion);
                ?>
            </table>
        </div>
        <div>
            <a href="nuevo_usuario.php" class="btn btn-primary">Crear nuevo usuario</a>
        </div>
    </div>
</body>

</html>