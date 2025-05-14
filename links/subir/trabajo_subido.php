<?php
    include("../../bd/conexion.php");

    // Inicia la sesión
    session_start();

    // Verifica si el usuario está logueado.
    if (!isset($_SESSION['usuario'])) {
        // Si no está logueado, redirige a la página de inicio de sesión.
        header("Location: ../login.php");
        // exit();
    }else {

        //sino, calculamos el tiempo transcurrido
        $fechaGuardada = $_SESSION["ultimoAcceso"];

        $ahora = date("Y-n-j H:i:s");
        $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
    
        //comparamos el tiempo transcurrido
        if($tiempo_transcurrido >= 1200) {
        //si pasaron 10 minutos o más
        session_destroy(); // destruyo la sesión
        header("Location: ../login.php"); //envío al usuario a la pag. de autenticación
        //sino, actualizo la fecha de la sesión
        }else {
        $_SESSION["ultimoAcceso"] = $ahora;
        }
    }

    $arregloUsuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head> 
    <?php
        include("../../layout/meta.php");
    ?>
    
    <!-- TITTLE -->
    <title>Exitosamente || L-Red</title>

    <!-- STYLES -->
    <link rel="stylesheet" href="../../css/subido.css">

    <?php
        include("../../layout/iconos.php");
    ?>
</head>
<body>
    <?php
        include("../../layout/nav.php");
    ?>

    <main>
        <section>
            <h2>Se ha subido correctamente el trabajo.</h2>
        </section>
    </main>

    <script src="../../js/main.js"></script>
</body>
</html>
