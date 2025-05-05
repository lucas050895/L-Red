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
        include("../layout/meta.php");
    ?>
    <!-- TITTLE -->
    <title>Buscar Trabajos CCTV || L-Red</title>
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
            <h2>Buscar Trabajos CCTV</h2>
        </section>

        <form action="buscar_cctv.php" method="GET">
            <fieldset>
                <legend>Filtros</legend>

                <div>
                    <label for="clientes_id">Cliente</label>
                    <select name="clientes_id" id="clientes_id" >
                        <option value="" selected disabled>Seleccionar Opción</option>
                        <?php
                            if($conexion) {
                                $consultation = "SELECT *
                                                    FROM clientes, trabajos_cctv
                                                    WHERE clientes.id = trabajos_cctv.clientes_id
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

                <div>
                    <label for="dvr_marca">Marca de DVR</label>
                    <input type="text" name="dvr_marca" id="dvr_marca">
                </div>

                <div>
                    <label for="camaras_modelo">Cámaras Modelo</label>
                    <input type="text" name="camaras_modelo" id="camaras_modelo">
                </div>
            </fieldset>

            <div class="container_button">
                <input type="submit" value="Buscar">
            </div>
        </form>

        <div class="container_items">
            <?php
                // Verifica si el formulario fue enviado
                if ($_SERVER['REQUEST_METHOD'] == 'GET' && 
                        isset($_GET['clientes_id']) || 
                        isset($_GET['dvr_marca']) ||
                        isset($_GET['camaras_modelo'])) {

                    // Recoger los filtros del formulario
                    $clientes_id     = $_GET['clientes_id']     ?? '';
                    $dvr_marca       = $_GET['dvr_marca']       ?? '';
                    $camaras_modelo  = $_GET['camaras_modelo']  ?? '';

                    // Construir la consulta SQL con filtros
                    $sql = "SELECT *
                                FROM clientes, trabajos_cctv
                                WHERE clientes.id = trabajos_cctv.clientes_id
                                AND 1 = 1";

                    if (!empty($clientes_id)) {
                        $sql .= " AND clientes_id = $clientes_id";
                    }

                    if (!empty($dvr_marca)) {
                        $sql .= " AND dvr_marca LIKE '%$dvr_marca%'";
                    }

                    if (!empty($camaras_modelo)) {
                        $sql .= " AND camaras_modelo LIKE '%$camaras_modelo%'";
                    }


                    $resultado = $conexion->query($sql);

                    // Mostrar resultados
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            ?>
                                <a href="#" class="items">
                                    <?php
                                        echo $fila['nombre']
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