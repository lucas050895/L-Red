<?php
// CONECXION A LA BASE DE DATOS (MYSQL)
    $server = 'localhost';
    $database = 'lred';
    $username = 'root';
    $password = '';

    //FORMA ORIENTADA A OBJETO
    $conexion = new mysqli($server,$username,$password, $database);
    //COMPROBAR CONECXION
    if($conexion->connect_error){
        die("Fallo la conecxion:  {$conexion->connect_error}");
    };



?>
