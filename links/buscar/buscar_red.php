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
    <title>Buscar Trabajos Red || L-Red</title>
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
            <h2>Buscar Trabajos de Red</h2>
        </section>

        <form action="buscar_red.php" method="GET">
            <fieldset>
                <legend>Filtros</legend>

                <div>
                    <label for="clientes_id">Cliente</label>
                    <select name="clientes_id" id="clientes_id" >
                        <option value="" selected disabled>Seleccionar Opción</option>
                        <?php
                            if($conexion) {
                                $consultation = "SELECT *
                                                    FROM clientes, trabajos_red
                                                    WHERE clientes.id = trabajos_red.clientes_id
                                                    ORDER BY nombre;";
                                $resultado = mysqli_query($conexion,$consultation);
                        
                                if($resultado){
                                    while($row = $resultado->fetch_array()){
                                        $clientes_id        = $row['clientes_id'];
                                        $nombre             = $row['nombre'];
                                        $apellido           = $row['apellido'];
                        
                                        ?>
                                            <option value="<?php echo $clientes_id ?>">
                                                <?php echo $nombre . " " . $apellido?>
                                            </option>
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </select>
                </div>

            </fieldset>

            <div class="container_button">
                <input type="submit" value="Buscar">
            </div>
        </form>

        <div class="container_items">
            <?php
                // Verifica si el formulario fue enviado
                if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['clientes_id']) ) {

                    // Recoger los filtros del formulario
                    $clientes_id       = $_GET['clientes_id']    ?? '';

                    // Construir la consulta SQL con filtros
                    $sql = "SELECT *
                                FROM clientes, trabajos_red
                                WHERE clientes.id = trabajos_red.clientes_id
                                AND 1 = 1";

                    if (!empty($nombre)) {
                        $sql .= " AND clientes_id = $clientes_id";
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