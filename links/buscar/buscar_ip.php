<?php
    include('../../bd/conecxion.php');
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
    <title>Buscar Trabajos IP || L-Red</title>
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
            <h2>Buscar Trabajos IP</h2>
        </section>

        <form action="buscar_ip.php" method="GET">
            <fieldset>
                <legend>Filtros</legend>
                <div>
                    <label for="id_clientes">Cliente <span>(*)</span></label>
                    <select name="id_clientes" id="id_clientes" required>
                        <option value="" selected disabled>Seleccionar Opción</option>
                        <?php
                            if($conexion) {
                                $consultation = "SELECT clientes.id, clientes.nombre, clientes.apellido
                                                    FROM clientes, trabajos_ip
                                                    WHERE clientes.id = trabajos_ip.id_clientes";
                                $resultado = mysqli_query($conexion,$consultation);
                        
                                if($resultado){
                                    while($row = $resultado->fetch_array()){
                                        $id       = $row['id'];
                                        $nombre   = $row['nombre'];
                                        $apellido = $row['apellido'];
                        
                                        ?>
                                            <option value="<?php echo $id ?>">
                                                <?php echo $nombre . " " . $apellido?>
                                            </option>
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </select>
                </div>

                <div>
                    <label for="acceso_host">Host</label>
                    <input type="text" id="acceso_host" name="acceso_host">
                </div>
            </fieldset>

            <div class="container_button">
                <input type="submit" value="Buscar" name="buscar">
            </div>
        </form>

        <div class="container_items">
            <?php
                // Verifica si el formulario fue enviado
                if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['nombre']) || isset($_GET['acceso_host'])) {

                    // Recoger los filtros del formulario
                    $nombre       = $_GET['nombre']    ?? '';
                    $acceso_host  = $_GET['acceso_host']  ?? '';

                    // Construir la consulta SQL con filtros
                    $sql = "SELECT * FROM trabajos_ip WHERE 1=1";

                    if (!empty($nombre)) {
                        $sql .= " AND nombre LIKE '%$nombre%'";
                    }

                    if (!empty($acceso_host)) {
                        $sql .= " AND acceso_host LIKE '%$acceso_host%'";
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