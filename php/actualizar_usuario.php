<?php

include("../bd/conexion.php");

    $id = $_POST['id'];

    $usuario = $_POST['usuario'];
    
    // $password = $_POST['password'];

    $conexion->query("UPDATE usuarios
                        SET usuario = '$usuario'
                        WHERE id=$id");
                        
    session_start();
    session_destroy();
    header("Location: http://lucasconde.ddns.net/L-Red/links/login.php");
?>
