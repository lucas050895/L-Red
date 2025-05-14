<?php
    include('../bd/conexion.php');

    $usuario        =   $_POST['usuario'];
    $password       =   $_POST['password'];
    $nivel          =   $_POST['nivel'];


    if(isset($_POST['submit'])){
        $sql = "INSERT INTO usuarios(
                                    usuario,
                                    password,
                                    usuarios_nivel
                                    )
                            VALUES (
                                        '{$usuario}',
                                        '{$password}',
                                        '{$nivel}'
                                    )";
        mysqli_query($conexion, $sql);
    }

    // Cerrar conexión a la base de datos
    mysqli_close($conexion);

    // Redirigir a la página de exitoso
    header("Location: ../../links/subir/usuario_subido.php");