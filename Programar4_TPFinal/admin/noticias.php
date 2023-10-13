<?php
session_start();
extract($_REQUEST);
if (!isset($_SESSION['usuario_logueado']))
    header("location:index.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>
    <link href="./lib/bootstrap-5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="./lib/bootstrap-5.3.2/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container-fluid">
        <?php require("menu.php");?>
        <h1>Noticias</h1>
        <div clas="mt-2 mb-2">
            <?php
                if(isset($mensaje))
                    print("<h3 style='color:#cc00ff'>".$mensaje."</h3>");
            ?>
        </div>
        <div class="d-flex justify-content-end">
            <a href="noticias_nueva.php" class="btn btn-primary">Nueva Noticia</a>
        </div>
        
    </div>
    <table class="table">
        <tr>
            <th>Titulo</th>
            <th>Copete</th>
            <th>Imagen</th>
            <th>Editar</th>
            <th>Borrar</th>
            <th>Autor</th>

        </tr>
    <?php
        require("conexion.php");
        $conexion = mysqli_connect($server_db, $usuario_db, $password_db)
            or die("No se puede conectar con el servidor");
        mysqli_select_db($conexion, $base_db)
            or die("No se puede seleccionar la base de datos");
         $instruccion="select * from noticias  order by fecha desc LIMIT 10";

            $consulta=mysqli_query($conexion,$instruccion) or die("no puedo consultar");

            $nfilas=mysqli_num_rows($consulta);

        for($i=0; $i<$nfilas; $i++)
        {
            $resultado=mysqli_fetch_array($consulta);
            $imagenPath = trim($resultado['imagen']);

                // Ejecutar la consulta
            $id_usuario_noticia = $resultado['id_usuario'];
            $instruccion2 = "select nombre from usuarios where id_usuario = $id_usuario_noticia ";
            $resultadoConsulta = mysqli_query($conexion, $instruccion2);
            $nombreUsuario = mysqli_fetch_assoc($resultadoConsulta);
            /*$partes = explode('-',$imagenPath); ESTO PARA QUITAR EL IDUNICO Y EL GUION EN CASO DE QUERER EL NMOBRE ORIGINAL DE LA IMAGEN
            $nombreImagenSinID = end($partes);*/

            print('
            <tr>
                <td>'.trim($resultado['titulo']).'</td>
                <td>'.substr($resultado['copete'],0,50).'...</td>
                <td><img src="imagenes/'. $imagenPath.'" alt="Imagen de la noticia" width="100" height="100"></td>
                <td><a href="noticias_editar.php?id_noticia='.$resultado['id_noticia'].'" class="btn btn-secondary">editar</a></td>
                <td><a href="noticias_borrar.php?id_noticia='.$resultado['id_noticia'].'&imagen='.$resultado['imagen'].'" class="btn btn-danger" onclick="return confirm(&quot; Desea eliminar &quot;)">borrar</a></td>
                <td>'.(isset($nombreUsuario['nombre']) ? trim($nombreUsuario['nombre']) : 'Nombre no disponible').'</td>
            </tr>
            
            ');
        }
        mysqli_close($conexion);
    ?>
    </table>
</body>

</html>