<?php
    include("../../bd/conexion.php");
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
?>
<!DOCTYPE html>
<html lang="es">
<head> 
    <?php
        include("../../layout/meta.php");
    ?>
    
    <!-- TITTLE -->
    <title>Buscar Clientes || L-Red</title>

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
            <h2>Buscar Clientes</h2>
        </section>

        <form action="buscar_cliente.php" method="GET">
            <fieldset>
                <legend>Filtros</legend>

                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre">
                </div>

                <div>
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Apellido">
                </div>

                <div>
                    <label for="razon">Razón Social</label>
                    <input type="text" id="razon" name="razon" placeholder="Razón Social">
                </div>

                <div>
                    <label for="celular">Celular</label>
                    <input type="number" id="celular" name="celular" placeholder="Celular">
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