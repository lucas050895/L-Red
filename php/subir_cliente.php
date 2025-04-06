<?php
    include('../bd/conecxion.php');

    $nombre         =   $_POST['nombre']; 
    $apellido       =   $_POST['apellido'];

    $razon          =   $_POST['razon'];
    $cuilcuit       =   $_POST['cuilcuit'];

    $celular        =   $_POST['celular'];
    $otro           =   $_POST['otro'];
    $email          =   $_POST['email'];

    $direccion      =   $_POST['direccion'];
    $localidad      =   $_POST['localidad'];

    if(isset($_POST['submit'])){
        $sql = "INSERT INTO clientes (nombre, apellido, razon, cuilcuit, celular, otro, email, direccion,localidad) VALUES ('{$nombre}' , '{$apellido}' , '{$razon}' , '{$cuilcuit}' , '{$celular}' , '{$otro}' , '{$email}' , '{$direccion}' , '{$localidad}')";
        mysqli_query($conexion, $sql);
    }

    // Cerrar conexión a la base de datos
    mysqli_close($conexion);

    // Redirigir a la página de exitoso
    header("Location: ../links/cliente_subido.php");
?>
