<?php
    session_start();
        extract($_REQUEST);
    if (!isset($_SESSION['usuario_logueado']))
        header("location:index.php");

        if ($contraseña == $comprobar_contraseña){
            require("conexion.php");
            $conexion = mysqli_connect($server_db, $usuario_db, $password_db)
                or die("No se puede conectar con el servidor");
            mysqli_select_db($conexion, $base_db)
                or die("No se puede seleccionar la base de datos");
        // $fecha=date("Y-m-d");
        //  $id_usuario=$_SESSION['id_usuario'];
            //metodo 1
            $nombre=mysqli_real_escape_string($conexion,$nombre);
            $apellido=mysqli_real_escape_string($conexion,$apellido);
            $usuario=mysqli_real_escape_string($conexion,$usuario);
            $contraseña=mysqli_real_escape_string($conexion,$contraseña);
        
            /*ENCRIPTAR <CLAVE*></CLAVE*/
        
            $salt = substr($usuario,0,2);
            $contrasena_encriptada = crypt($contraseña,$salt);
        

           
        
            $instruccion=" update usuarios set nombre='$nombre',apellido='$apellido',usuario='$usuario',password='$contrasena_encriptada' where id_usuario='$id_usuario'";
            $consulta=mysqli_query($conexion,$instruccion) 
                    or die("no pudo insertar");
            if ($consulta) {
                echo "<script>console.log('Usuario guardado correctamente.');</script>";
            } else {
                $error_message = "Error al guardar el usuario: " . mysqli_error($conexion);
                echo "<script>console.error('$error_message');</script>";
            }
            mysqli_close($conexion);
            header("location:usuarios.php?mensaje=Usuario guradado con exito");
        
        }
        else {
            header("location:nuevo_usuario.php?mensaje=Contraseñas no coinciden&nombre=" . urlencode($nombre));
        }
?>  



