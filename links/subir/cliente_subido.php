<?php
    include("../../bd/conexion.php");

    // Inicia la sesión
    session_start();

    // Verifica si el usuario está logueado.
    if (!isset($_SESSION['usuario'])) {
        // Si no está logueado, redirige a la página de inicio de sesión.
        header("Location: ../login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head> 
    <?php
        include("../layout/meta.php");
    ?>
    <!-- TITTLE -->
    <title>Exitosamente || L-Red</title>
    <!-- STYLES -->
    <link rel="stylesheet" href="../../css/subido.css">
    <!-- BOXICONS  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php
        include("../../layout/nav.php");
    ?>

    <main>
        <section>
            <h2>Se ha subido correctamente el cliente.</h2>
        </section>
    </main>

    <script src="../../js/main.js"></script>
</body>
</html>
