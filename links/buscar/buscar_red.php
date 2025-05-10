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
<html lang="en">
<head> 
    <?php
        include("../../layout/meta.php");
    ?>
    
    <!-- TITTLE -->
    <title>Buscar Trabajos Red || L-Red</title>

    <!-- STYLES -->
    <link rel="stylesheet" href="../../css/buscar_todos.css">

    <?php
        include("../../layout/iconos.php");
    ?>
</head>
<body>
    <?php
        include("../../layout/nav.php");
    ?>

    <main>
        <section class="title">
            <i class='bx bxs-user-detail'></i>
            <h2>Buscar Trabajos de Red</h2>
        </section>

        <form action="buscar_red.php" method="GET">
            <fieldset>
                <legend>Filtros</legend>

                <div>
                    <label for="nombre">Cliente</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre">
                </div>

            </fieldset>

            <div class="container_button">
                <input type="submit" value="Buscar">
            </div>
        </form>

        <div class="container_items">
            <?php
                // Verifica si el formulario fue enviado
                if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['nombre']) ) {

                    // Recoger los filtros del formulario
                    $nombre       = $_GET['nombre']    ?? '';
                    $apellido       = $_GET['apellido']    ?? '';

                    // Construir la consulta SQL con filtros
                    $sql = "SELECT *
                                FROM clientes, trabajos_red
                                WHERE clientes.id = trabajos_red.clientes_id
                                AND 1 = 1";

                    if (!empty($nombre)) {
                        $sql .= " AND nombre LIKE '%$nombre%' ";
                    }

                    $resultado = $conexion->query($sql);

                    // Mostrar resultados
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            ?>
                                <a href="#" class="items">
                                    <?php
                                        echo $fila['nombre'] . " " . $fila['apellido']
                                    ?>
                                </a>
                            <?php
                        }
                    } else {
                        ?>
                            <p>No se encontraron resultados.</p>
                        <?php
                    }
                }else{
                    ?>
                        <p>Por favor, ingrese algún dato.</p>
                    <?php
                }

                $conexion->close();
            ?>
        </div>

    
    </main>

    <script src="../../js/main.js"></script>
</body>
</html>