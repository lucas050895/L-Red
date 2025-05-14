<?php
    include("../../bd/conexion.php");
    // Inicia la sesión
    session_start();

    // Verifica si el usuario está logueado.
    if (!isset($_SESSION['usuario'])) {
        // Si no está logueado, redirige a la página de inicio de sesión.
        header("Location: ../login.php");
        exit();
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
        exit();
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

    <!-- TITLE -->
    <title>Presupuestador || L-Red</title>

    <!-- STYLES -->
    <link rel="stylesheet" href="../../css/presupuestador.css">

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
            <i class='bx bxs-dollar-circle'></i>
            <h2>Presupuestador</h2>
        </section>

        <form method="POST">
            <select name="clientes" id="clientes">
                <option value="" selected disabled>Seleccionar Cliente</option>
                <?php
                    $resultadoClientes = $conexion->query("SELECT * FROM clientes ORDER BY nombre");
                    while ($fila = $resultadoClientes->fetch_assoc()) {
                        $selected = (isset($_POST['clientes']) && $_POST['clientes'] == $fila['id']) ? "selected" : "";
                        echo "<option value='{$fila['id']}' $selected>";
                        echo !empty($fila['razon']) ? $fila['razon'] : "{$fila['nombre']} {$fila['apellido']}";
                        echo "</option>";
                    }
                ?>
            </select>

            <table>
                <!-- ENCABEZADO -->
                <thead>
                    <tr>
                        <td>Producto</td>
                        <td>Cant</td>
                        <td>Precio</td>
                        <td>Subtotal</td>
                    </tr>
                </thead>

                <tbody>
                    <!-- FILA DE DVR -->
                    <tr>
                        <td>
                            <div>
                                <label for="producto_dvr">Dvr</label>
                                <select name="producto_dvr" id="producto_dvr">
                                    <option value="" selected disabled>Seleccionar dvr</option>
                                    <?php
                                    $resultadoDVR = $conexion->query("SELECT * FROM presupuestador_dvr");
                                    while ($fila = $resultadoDVR->fetch_assoc()) {
                                        $selected = (isset($_POST['producto_dvr']) && $_POST['producto_dvr'] == $fila['precio_venta']) ? "selected" : "";
                                        echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input type="number" min="0" max="16" name="cantidad_dvr" value="<?= isset($_POST['cantidad_dvr']) ? $_POST['cantidad_dvr'] : 1 ?>">
                            </div>
                        </td>

                        <td>
                            <span>
                                <?=
                                    isset($_POST['producto_dvr']) ?  "$" . number_format($_POST['producto_dvr'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>

                        <td>
                            <span>
                                <?=
                                    $total_dvr = isset($_POST['producto_dvr']) && isset($_POST['cantidad_dvr']) ? "$" . number_format($_POST['producto_dvr'] * $_POST['cantidad_dvr'], 0, ',', '.') : ''
                                ?>
                            </span>

                        </td>
                    </tr>
     
                    <!-- FILA DE CAMARAS -->
                    <tr>
                        <td>
                            <div>
                                <label for="producto_camara">Cámaras</label>
                                <select name="producto_camara" id="producto_camara">
                                    <option value="" selected disabled>Seleccionar cámaras</option>
                                    <?php
                                    $resultadoCamara = $conexion->query("SELECT * FROM presupuestador_camaras");
                                    while ($fila = $resultadoCamara->fetch_assoc()) {
                                        $selected = (isset($_POST['producto_camara']) && $_POST['producto_camara'] == $fila['precio_venta']) ? "selected" : "";
                                        echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input type="number" min="0" max="16" name="cantidad_camara" value="<?= isset($_POST['cantidad_camara']) ? $_POST['cantidad_camara'] : 1 ?>">
                            </div>
                        </td>

                        <td>
                            <span>
                                <?=
                                    isset($_POST['producto_camara']) ?  "$" . number_format($_POST['producto_camara'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>

                        <td>
                            <span>
                                <?=
                                    $total_camaras = isset($_POST['producto_camara']) && isset($_POST['cantidad_camara']) ? "$" . number_format($_POST['producto_camara'] * $_POST['cantidad_camara'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>
                    </tr>

                    <!-- FILA DE CABLE UTP -->
                    <tr>
                        <td>
                            <div>
                                <label for="producto_utp">Cable utp</label>
                                <select name="producto_utp" id="producto_utp">
                                    <option value="" selected disabled>Seleccionar cable utp</option>
                                    <?php
                                    $resultadoCamara = $conexion->query("SELECT * FROM presupuestador_utp");
                                    while ($fila = $resultadoCamara->fetch_assoc()) {
                                        $selected = (isset($_POST['producto_utp']) && $_POST['producto_utp'] == $fila['precio_venta']) ? "selected" : "";
                                        echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input type="number" min="0" max="305" name="cantidad_utp" value="<?= isset($_POST['cantidad_utp']) ? $_POST['cantidad_utp'] : 1 ?>">
                            </div>
                        </td>

                        <td>
                            <span>
                                <?=
                                    isset($_POST['producto_utp']) ?  "$" . number_format($_POST['producto_utp'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>

                        <td>
                            <span>
                                <?=
                                    $total_utp = isset($_POST['producto_utp']) && isset($_POST['cantidad_utp']) ? "$" . number_format($_POST['producto_utp'] * $_POST['cantidad_utp'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>
                    </tr>

                    <!-- FILA DE FUENTES -->
                    <tr>
                        <td>
                            <div>
                                <label for="producto_fuentes">Fuentes</label>
                                <select name="producto_fuentes" id="producto_fuentes">
                                    <option value="" selected disabled>Seleccionar fuentes</option>
                                    <?php
                                    $resultadoCamara = $conexion->query("SELECT * FROM presupuestador_fuentes");
                                    while ($fila = $resultadoCamara->fetch_assoc()) {
                                        $selected = (isset($_POST['producto_fuentes']) && $_POST['producto_fuentes'] == $fila['precio_venta']) ? "selected" : "";
                                        echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input type="number" min="0" max="305" name="cantidad_fuentes" value="<?= isset($_POST['cantidad_fuentes']) ? $_POST['cantidad_fuentes'] : 1 ?>">
                            </div>
                        </td>

                        <td>
                            <span>
                                <?=
                                    isset($_POST['producto_fuentes']) ?  "$" . number_format($_POST['producto_fuentes'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>

                        <td>
                            <span>
                                <?=
                                    $total_fuente = isset($_POST['producto_fuentes']) && isset($_POST['cantidad_fuentes']) ? "$" . number_format($_POST['producto_fuentes'] * $_POST['cantidad_fuentes'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>
                    </tr>

                    <!-- FILA DE BALUN -->
                    <tr>
                        <td>
                            <div>
                                <label for="producto_balun">Balun</label>
                                <select name="producto_balun" id="producto_balun">
                                    <option value="" selected disabled>Seleccionar balun</option>
                                    <?php
                                    $resultadoCamara = $conexion->query("SELECT * FROM presupuestador_balun");
                                    while ($fila = $resultadoCamara->fetch_assoc()) {
                                        $selected = (isset($_POST['producto_balun']) && $_POST['producto_balun'] == $fila['precio_venta']) ? "selected" : "";
                                        echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input type="number" min="0" max="305" name="cantidad_balun" value="<?= isset($_POST['cantidad_balun']) ? $_POST['cantidad_balun'] : 1 ?>">
                            </div>
                        </td>

                        <td>
                            <span>
                                <?=
                                    isset($_POST['producto_balun']) ?  "$" . number_format($_POST['producto_balun'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>

                        <td>
                            <span>
                                <?=
                                    $total_balun = isset($_POST['producto_balun']) && isset($_POST['cantidad_balun']) ? "$" . number_format($_POST['producto_balun'] * $_POST['cantidad_balun'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>
                    </tr>

                    <!-- FILA DE CAJA ESTANCA -->
                    <tr>
                        <td>
                            <div>
                                <label for="producto_caja">Caja estanca</label>
                                <select name="producto_caja" id="producto_caja">
                                    <option value="" selected disabled>Seleccionar caja estanca</option>
                                    <?php
                                    $resultadoCamara = $conexion->query("SELECT * FROM presupuestador_caja");
                                    while ($fila = $resultadoCamara->fetch_assoc()) {
                                        $selected = (isset($_POST['producto_caja']) && $_POST['producto_caja'] == $fila['precio_venta']) ? "selected" : "";
                                        echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input type="number" min="0" max="305" name="cantidad_caja" value="<?= isset($_POST['cantidad_caja']) ? $_POST['cantidad_caja'] : 1 ?>">
                            </div>
                        </td>

                        <td>
                            <span>
                                <?=
                                    isset($_POST['producto_caja']) ?  "$" . number_format($_POST['producto_caja'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>

                        <td>
                            <span>
                                <?=
                                    $total_caja = isset($_POST['producto_caja']) && isset($_POST['cantidad_caja']) ? "$" . number_format($_POST['producto_caja'] * $_POST['cantidad_caja'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>
                    </tr>

                    <!-- FILA DE BALUNERA -->
                    <tr>
                        <td>
                            <div>
                                <label for="producto_balunera">Balunera</label>
                                <select name="producto_balunera" id="producto_balunera">
                                    <option value="" selected disabled>Seleccionar balunera</option>
                                    <?php
                                    $resultadoCamara = $conexion->query("SELECT * FROM presupuestador_balunera");
                                    while ($fila = $resultadoCamara->fetch_assoc()) {
                                        $selected = (isset($_POST['producto_balunera']) && $_POST['producto_balunera'] == $fila['precio_venta']) ? "selected" : "";
                                        echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input type="number" min="0" max="305" name="cantidad_balunera" value="<?= isset($_POST['cantidad_balunera']) ? $_POST['cantidad_balunera'] : 1 ?>">
                            </div>
                        </td>

                        <td>
                            <span>
                                <?=
                                    isset($_POST['producto_balunera']) ?  "$" . number_format($_POST['producto_balunera'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>

                        <td>
                            <span>
                                <?=
                                    $total_balunera = isset($_POST['producto_balunera']) && isset($_POST['cantidad_balunera']) ? "$" . number_format($_POST['producto_balunera'] * $_POST['cantidad_balunera'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>
                    </tr>

                    <!-- FILA DE INSUMOS -->
                    <tr>
                        <td>
                            <div>
                                <label for="producto_insumos">Insumos</label>
                                <select name="producto_insumos" id="producto_insumos">
                                    <option value="" selected disabled>Seleccionar insumos</option>
                                    <?php
                                    $resultadoCamara = $conexion->query("SELECT * FROM presupuestador_insumos");
                                    while ($fila = $resultadoCamara->fetch_assoc()) {
                                        $selected = (isset($_POST['producto_insumos']) && $_POST['producto_insumos'] == $fila['precio_venta']) ? "selected" : "";
                                        echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input type="number" min="0" max="305" name="cantidad_insumos" value="<?= isset($_POST['cantidad_insumos']) ? $_POST['cantidad_insumos'] : 1 ?>">
                            </div>
                        </td>

                        <td>
                            <span>
                                <?=
                                    isset($_POST['producto_insumos']) ?  "$" . number_format($_POST['producto_insumos'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>

                        <td>
                            <span>
                                <?=
                                    $total_insumos = isset($_POST['producto_insumos']) && isset($_POST['cantidad_insumos']) ? "$" . number_format($_POST['producto_insumos'] * $_POST['cantidad_insumos'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>
                    </tr>

                    <!-- FILA DE ZAPATILLA ELECTRICA -->
                    <tr>
                        <td>
                            <div>
                                <label for="producto_zapatilla">Zapatilla eléctrica</label>
                                <select name="producto_zapatilla" id="producto_zapatilla">
                                    <option value="" selected disabled>Seleccionar zapatilla eléctrica</option>
                                    <?php
                                    $resultadoCamara = $conexion->query("SELECT * FROM presupuestador_zapatilla");
                                    while ($fila = $resultadoCamara->fetch_assoc()) {
                                        $selected = (isset($_POST['producto_zapatilla']) && $_POST['producto_zapatilla'] == $fila['precio_venta']) ? "selected" : "";
                                        echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input type="number" min="0" max="305" name="cantidad_zapatilla" value="<?= isset($_POST['cantidad_zapatilla']) ? $_POST['cantidad_zapatilla'] : 1 ?>">
                            </div>
                        </td>

                        <td>
                            <span>
                                <?=
                                    isset($_POST['producto_zapatilla']) ?  "$" . number_format($_POST['producto_zapatilla'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>

                        <td>
                            <span>
                                <?=
                                    $total_zapatilla = isset($_POST['producto_zapatilla']) && isset($_POST['cantidad_zapatilla']) ? "$" . number_format($_POST['producto_zapatilla'] * $_POST['cantidad_zapatilla'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>
                    </tr>

                    <!-- FILA DE MANO DE OBRA -->
                    <tr>
                        <td>
                            <div>
                                <label for="mo">Mano de Obra</label>
                                <select name="mo" id="mo">
                                    <option value="" selected disabled>Seleccionar M.O.</option>
                                    <?php
                                    $resultadoDVR = $conexion->query("SELECT * FROM presupuestador_mano");
                                    while ($fila = $resultadoDVR->fetch_assoc()) {
                                        $selected = (isset($_POST['m_o']) && $_POST['m_o'] == $fila['precio_venta']) ? "selected" : "";
                                        echo "<option value='{$fila['precio_venta']}' $selected>{$fila['m_o']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input type="number" min="0" max="5" name="cantidad_mano" value="<?= isset($_POST['cantidad_mano']) ? $_POST['cantidad_mano'] : 1 ?>">
                            </div>
                        </td>

                        <td>
                            <span>
                                <?=
                                    isset($_POST['producto_mano']) ?  "$" . number_format($_POST['producto_mano'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>

                        <td>
                            <span>
                                <?=
                                    $total_mano = isset($_POST['producto_mano']) && isset($_POST['cantidad_mano']) ? "$" . number_format($_POST['producto_mano'] * $_POST['cantidad_mano'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>
                    </tr>

                </tbody>

                <!-- ENCABEZADO DEL TOTAL -->
                <thead>
                    <tr>
                        <td colspan="3">Total</td>
                        <td colspan="1">
                            <span>
                                <!-- SUMA DE TODOS LOS PRODUCTOS -->
                                <?php
                                    // Inicializamos la variable totalGeneral en 0
                                    $totalGeneral = 0;

                                    // Función para calcular el subtotal de cada producto (evitando errores)
                                    function calcularSubtotal($producto, $cantidad) {
                                        return (isset($_POST[$producto]) && isset($_POST[$cantidad])) ? $_POST[$producto] * $_POST[$cantidad] : 0;
                                    }

                                    // Sumamos todos los productos
                                    $totalGeneral += calcularSubtotal('producto_dvr', 'cantidad_dvr');
                                    $totalGeneral += calcularSubtotal('producto_camara', 'cantidad_camara');
                                    $totalGeneral += calcularSubtotal('producto_utp', 'cantidad_utp');
                                    $totalGeneral += calcularSubtotal('producto_fuentes', 'cantidad_fuentes');
                                    $totalGeneral += calcularSubtotal('producto_balun', 'cantidad_balun');
                                    $totalGeneral += calcularSubtotal('producto_caja', 'cantidad_caja');
                                    $totalGeneral += calcularSubtotal('producto_balunera', 'cantidad_balunera');
                                    $totalGeneral += calcularSubtotal('producto_insumos', 'cantidad_insumos');
                                    $totalGeneral += calcularSubtotal('producto_zapatilla', 'cantidad_zapatilla');

                                    // Mostramos el total formateado en la tabla
                                    echo "$" . number_format($totalGeneral, 0, ',', '.');
                                ?>
                            </span>
                        </td>
                    </tr>
                </thead>

            </table>


            <button type="submit">Calcular</button>
        </form>

        <form method="POST" action="generar_pdf.php" class="formulario">


            <input type="hidden" name="cliente_id" value="<?= $_POST['clientes'] ?? '' ?>">
            
            <?php
            if (isset($_POST['clientes'])) {
                $idCliente = $_POST['clientes'];
                $consultaCliente = $conexion->query("SELECT * FROM clientes WHERE id = $idCliente");
                $datosCliente = $consultaCliente->fetch_assoc();
            ?>
                <input type="hidden" name="cliente_nombre" value="<?= $datosCliente['nombre'] ?>">
                <input type="hidden" name="cliente_apellido" value="<?= $datosCliente['apellido'] ?>">
                <input type="hidden" name="cliente_razon" value="<?= $datosCliente['razon'] ?>">
            <?php } ?>

            <!-- DVR -->
            <input type="hidden" name="producto_dvr" value="<?= $_POST['producto_dvr'] ?? 0 ?>">
            <input type="hidden" name="cantidad_dvr" value="<?= $_POST['cantidad_dvr'] ?? 0 ?>">
            <input type="hidden" name="subtotal_dvr" value="<?= $_POST['producto_dvr'] ?? 0 ?>">

            <!-- Cámaras -->
            <input type="hidden" name="producto_camara" value="<?= $_POST['producto_camara'] ?? 0 ?>">
            <input type="hidden" name="cantidad_camara" value="<?= $_POST['cantidad_camara'] ?? 0 ?>">
            <input type="hidden" name="subtotal_camara" value="<?= $_POST['producto_camara'] ?? 0 ?>">

            <!-- Cable UTP -->
            <input type="hidden" name="producto_utp" value="<?= $_POST['producto_utp'] ?? 0 ?>">
            <input type="hidden" name="cantidad_utp" value="<?= $_POST['cantidad_utp'] ?? 0 ?>">
            <input type="hidden" name="subtotal_utp" value="<?= $_POST['producto_utp']  ?? 0 ?>">

            <!-- Fuentes -->
            <input type="hidden" name="producto_fuentes" value="<?= $_POST['producto_fuentes'] ?? 0 ?>">
            <input type="hidden" name="cantidad_fuentes" value="<?= $_POST['cantidad_fuentes'] ?? 0 ?>">
            <input type="hidden" name="subtotal_fuentes" value="<?= $_POST['producto_fuentes'] ?? 0 ?>">

            <!-- Balun -->
            <input type="hidden" name="producto_balun" value="<?= $_POST['producto_balun'] ?? 0 ?>">
            <input type="hidden" name="cantidad_balun" value="<?= $_POST['cantidad_balun'] ?? 0 ?>">
            <input type="hidden" name="subtotal_balun" value="<?= $_POST['producto_balun']  ?? 0 ?>">

            <!-- Caja estanca -->
            <input type="hidden" name="producto_caja" value="<?= $_POST['producto_caja'] ?? 0 ?>">
            <input type="hidden" name="cantidad_caja" value="<?= $_POST['cantidad_caja'] ?? 0 ?>">
            <input type="hidden" name="subtotal_caja" value="<?= $_POST['producto_caja']  ?? 0 ?>">

            <!-- Balunera -->
            <input type="hidden" name="producto_balunera" value="<?= $_POST['producto_balunera'] ?? 0 ?>">
            <input type="hidden" name="cantidad_balunera" value="<?= $_POST['cantidad_balunera'] ?? 0 ?>">
            <input type="hidden" name="subtotal_balunera" value="<?= $_POST['producto_balunera'] ?? 0 ?>">

            <!-- Insumos -->
            <input type="hidden" name="producto_insumos" value="<?= $_POST['producto_insumos'] ?? 0 ?>">
            <input type="hidden" name="cantidad_insumos" value="<?= $_POST['cantidad_insumos'] ?? 0 ?>">
            <input type="hidden" name="subtotal_insumos" value="<?= $_POST['producto_insumos'] ?? 0 ?>">

            <!-- Zapatilla eléctrica -->
            <input type="hidden" name="producto_zapatilla" value="<?= $_POST['producto_zapatilla'] ?? 0 ?>">
            <input type="hidden" name="cantidad_zapatilla" value="<?= $_POST['cantidad_zapatilla'] ?? 0 ?>">
            <input type="hidden" name="subtotal_zapatilla" value="<?= $_POST['producto_zapatilla'] ?? 0 ?>">

            <input type="hidden" name="total_general" value="<?= $totalGeneral ?? 0 ?>">
            
            <button type="submit">Exportar a PDF</button>
        </form>

    </main>

    <?php $conexion->close(); ?>

    <script>
        document.querySelector(".formulario").addEventListener("submit", function (event) {
            let totalGeneral = <?= $totalGeneral ?>;
            
            if (totalGeneral === 0) {
                alert("No puedes generar el PDF sin calcular un precio primero.");
                event.preventDefault(); // Evita el envío del formulario
            }
        });
    </script>

</body>
</html>