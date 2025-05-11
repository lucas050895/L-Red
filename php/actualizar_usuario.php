<?php

include("../bd/conexion.php");

    $id = $_POST['id'];

    $usuario = $_POST['usuario'];
    
    // $password = $_POST['password'];

    $conexion->query("UPDATE usuarios
                        SET usuario = '$usuario'
                        WHERE id=$id");

    header("Location: ../links/subir/actualizado.php");
?>
