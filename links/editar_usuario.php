<?php

    include("../bd/conexion.php");

        // Inicia la sesión
    session_start();

    // Verifica si el usuario está logueado.
    if (!isset($_SESSION['usuario'])) {
        // Si no está logueado, redirige a la página de inicio de sesión.
        header("Location: login.php");
        // exit();
    }else {
        //sino, calculamos el tiempo transcurrido
        $fechaGuardada = $_SESSION["ultimoAcceso"];

        $ahora = date("Y-n-j H:i:s");
        $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
  
        //comparamos el tiempo transcurrido
        if($tiempo_transcurrido >= 60) {
        //si pasaron 10 minutos o más
            session_destroy(); // destruyo la sesión
            header("Location: login.php"); //envío al usuario a la pag. de autenticación
            //sino, actualizo la fecha de la sesión
        }else {
            $_SESSION["ultimoAcceso"] = $ahora;
        }
    }

    $arregloUsuario = $_SESSION['usuario']; 

    $id = $_GET['id'];

    $resultado = $conexion->query("SELECT * FROM usuarios WHERE id = $id");

    $fila = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include("../layout/meta.php");
    ?>

    <title>Editar Usuario || L-Red</title>

    <link rel="stylesheet" href="../css/editar_todos.css">

    <?php
        include("../layout/iconos.php");
    ?>
</head>
<body>
    <?php
        include("../layout/nav.php");
    ?>

    <main>
        <section class="title">
            <i class="fa-solid fa-pen"></i>
            <h2>Editar</h2>
        </section>
        
        <form action="../php/actualizar_usuario.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <fieldset>
                <legend>Usuario</legend> 
                <div>
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" value="<?= $fila['usuario'] ?>">            
                </div>
            </fieldset>

            <div class="container_button">
                <input type="submit" value="Actualizar">
            </div>
        </form>
    </main>
</body>
</html>