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
    <!-- CHARSET -->
    <meta charset="UTF-8">
    <!-- IE-EDGE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- VIEWPORT -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- DESCRIPTION -->
    <meta name="description" content="L-Red">
    <!-- AUTHOR -->
    <meta name="author" content="Lucas Conde">
    <!-- TITTLE -->
    <title>Buscar Clientes || L-Red</title>
    <!-- STYLES -->
    <link rel="stylesheet" href="../../css/buscar_todos.css">
    <!-- BOXICONS  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php
        include("../../layout/nav.php");
    ?>
    
    <main>
        <section class="title">
            <i class='bx bxs-user-detail'></i>
            <h2>Buscar Clientes</h2>
        </section>

        <form action="buscar_cliente.php" method="GET">
            <fieldset>
                <legend>Filtros</legend>

                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre">
                </div>

                <div>
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido">
                </div>

                <div>
                    <label for="razon">Razón Social</label>
                    <input type="text" id="razon" name="razon">
                </div>

                <div>
                    <label for="celular">Celular</label>
                    <input type="number" id="celular" name="celular">
                </div>
            </fieldset>

            <div class="container_button">
                <input type="submit" value="Buscar">
            </div>

        </form>

        <div class="container_items">
            <?php
                // Verifica si el formulario fue enviado
                if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['nombre']) || isset($_GET['apellido']) || isset($_GET['razon']) || isset($_GET['celular'])) {

                    // Recoger los filtros del formulario
                    $nombre    = $_GET['nombre']    ?? '';
                    $apellido  = $_GET['apellido']  ?? '';
                    $razon     = $_GET['razon']     ?? '';
                    $celular   = $_GET['celular']   ?? '';

                    // Construir la consulta SQL con filtros
                    $sql = "SELECT * FROM clientes WHERE 1=1";

                    if (!empty($nombre)) {
                        $sql .= " AND nombre LIKE '%$nombre%'";
                    }

                    if (!empty($apellido)) {
                        $sql .= " AND apellido LIKE '%$apellido%'";
                    }

                    if (!empty($razon)) {
                        $sql .= " AND razon LIKE '%$razon%'";
                    }

                    if (!empty($celular)) {
                        $sql .= " AND celular = $celular";
                    }

                    $resultado = $conexion->query($sql);

                    // Mostrar resultados
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            ?>
                                <a href="cliente.php?id=<?php echo $fila['id']; ?>" class="items">
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