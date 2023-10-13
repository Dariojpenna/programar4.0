<?php
    extract($_REQUEST);
    if(isset($mensaje))
    {   
        isset($nombre);
        print("<p>".$mensaje."</p>");
    }
    

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo usuario</title>
    <link href="./lib/bootstrap-5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="./lib/bootstrap-5.3.2/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container">
        <form class="form w-50" action="usuario_nuevo_guardar.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido"  name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario"  required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" required>
            </div>
            <div class="mb-3">
                <label for="comprobar_contraseña" class="form-label">Repita Contraseña</label>
                <input type="password" class="form-control" id="comprobar_contraseña" name="comprobar_contraseña" required>
            </div>
            <div class="d-flex justify-content-between" >
                <div class="mb-3">
                    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="GUARDAR">
                </div>
                <div class="mb-3">
                    <a href="index.php" class="btn btn-success">Volver</a>
                </div>
            </div>

        </form>

    </div>

</body>

</html>

