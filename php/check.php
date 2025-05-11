<?php

    session_start();

    include("../bd/conexion.php");

    if(isset($_POST['usuario']) && isset($_POST['password'])){
        $resultado = $conexion->query("SELECT *
                                            FROM usuarios
                                            WHERE usuario ='".$_POST['usuario']."' AND
                                            password='".$_POST['password']."' LIMIT 1")or die($conexion->error);

        if(mysqli_num_rows($resultado)> 0){

            $datos_usuario = mysqli_fetch_row($resultado);


            $_SESSION['usuario'] = $usuario;
            $_SESSION['ultimoAcceso'] = date("Y-n-j H:i:s");

            // ID
            $id = $datos_usuario[0];
            // USUARIO
            $usuario = $datos_usuario[1];
            // PASSWORD
            $password = $datos_usuario[2];
            // USUARIOS_NIVEL
            $usuarios_nivel = $datos_usuario[3];

            $_SESSION['usuario'] = array(
                'id' => $id,
                'usuario' => $usuario,
                'password' => $password,
                'usuarios_nivel' => $usuarios_nivel,
            );
            header("Location: ../links/dashbord.php");
        }else{
            ?>
                <script>
                    alert("Usuario o password incorrectos.");
                    window.location.href = "http://lucasconde.ddns.net/L-Red/links/login.php";
                </script>
            <?php
        }
    }

?>