<?php

include("../bd/conexion.php");

    $id = $_POST['id'];

    $password = $_POST['password'];
    
    // $password = $_POST['password'];

    $conexion->query("UPDATE usuarios
                        SET password = '$password'
                        WHERE id=$id");
                        
    session_start();
    session_destroy();
    header("Location: http://lucasconde.ddns.net/L-Red/links/login.php");
?>
