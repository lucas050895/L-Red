<?php
    include("../bd/conexion.php");

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
        if($tiempo_transcurrido >= 60000) {
        //si pasaron 10 minutos o más
        session_destroy(); // destruyo la sesión
        header("Location: login.php"); //envío al usuario a la pag. de autenticación
        //sino, actualizo la fecha de la sesión
        }else {
        $_SESSION["ultimoAcceso"] = $ahora;
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        include("../layout/meta.php");
    ?>
    <title>Presupuestador || L-Red</title>

      <!-- STYLES -->
    <link rel="stylesheet" href="../css/presupuestador.css">

    <!-- BOXICONS  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/439ee37b3b.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include("../layout/nav.php");
    ?>
    
    <main>
        <section class="title">
            <i class='bx bxs-dollar-circle'></i>
            <h2>Presupuestador</h2>
        </section>

        <form method="POST">
            <table>
                <thead>
                    <tr>
                        <td>Producto</td>
                        <td>Cant</td>
                        <td>Precio</td>
                        <td>Subtotal</td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <select name="producto_dvr">
                                <option value="" selected disabled>DVR</option>
                                <?php
                                $resultadoDVR = $conexion->query("SELECT * FROM presupuestador_dvr");
                                while ($fila = $resultadoDVR->fetch_assoc()) {
                                    $selected = (isset($_POST['producto_dvr']) && $_POST['producto_dvr'] == $fila['precio_venta']) ? "selected" : "";
                                    echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                }
                                ?>
                            </select>
                        </td>

                        <td>
                            <input type="number" min="0" max="16" name="cantidad_dvr" value="<?= isset($_POST['cantidad_dvr']) ? $_POST['cantidad_dvr'] : 1 ?>">
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
                    
                    <tr>
                        <td>
                            <select name="producto_camara">
                                <option value="" selected disabled>Cámaras</option>
                                <?php
                                $resultadoCamara = $conexion->query("SELECT * FROM presupuestador_camaras");
                                while ($fila = $resultadoCamara->fetch_assoc()) {
                                    $selected = (isset($_POST['producto_camara']) && $_POST['producto_camara'] == $fila['precio_venta']) ? "selected" : "";
                                    echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                }
                                ?>
                            </select>
                        </td>

                        <td>
                            <input type="number" min="0" max="16" name="cantidad_camara" value="<?= isset($_POST['cantidad_camara']) ? $_POST['cantidad_camara'] : 1 ?>">
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

                    <tr>
                        <td>
                            <select name="producto_utp">
                                <option value="" selected disabled>Cable UTP</option>
                                <?php
                                $resultadoCamara = $conexion->query("SELECT * FROM presupuestador_utp");
                                while ($fila = $resultadoCamara->fetch_assoc()) {
                                    $selected = (isset($_POST['producto_utp']) && $_POST['producto_utp'] == $fila['precio_venta']) ? "selected" : "";
                                    echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                }
                                ?>
                            </select>
                        </td>

                        <td>
                            <input type="number" min="0" max="305" name="cantidad_utp" value="<?= isset($_POST['cantidad_utp']) ? $_POST['cantidad_utp'] : 1 ?>">
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

                    <tr>
                        <td>
                            <select name="producto_fuentes">
                                <option value="" selected disabled>Fuente</option>
                                <?php
                                $resultadoCamara = $conexion->query("SELECT * FROM presupuestador_fuentes");
                                while ($fila = $resultadoCamara->fetch_assoc()) {
                                    $selected = (isset($_POST['producto_fuentes']) && $_POST['producto_fuentes'] == $fila['precio_venta']) ? "selected" : "";
                                    echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                }
                                ?>
                            </select>
                        </td>

                        <td>
                            <input type="number" min="0" max="305" name="cantidad_fuente" value="<?= isset($_POST['cantidad_fuente']) ? $_POST['cantidad_fuente'] : 1 ?>">
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
                                    $total_fuente = isset($_POST['producto_fuentes']) && isset($_POST['cantidad_fuente']) ? "$" . number_format($_POST['producto_fuentes'] * $_POST['cantidad_fuente'], 0, ',', '.') : ''
                                ?>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <select name="producto_balun">
                                <option value="" selected disabled>Balun</option>
                                <?php
                                $resultadoCamara = $conexion->query("SELECT * FROM presupuestador_balun");
                                while ($fila = $resultadoCamara->fetch_assoc()) {
                                    $selected = (isset($_POST['producto_balun']) && $_POST['producto_balun'] == $fila['precio_venta']) ? "selected" : "";
                                    echo "<option value='{$fila['precio_venta']}' $selected>{$fila['nombre']}</option>";
                                }
                                ?>
                            </select>
                        </td>

                        <td>
                            <input type="number" min="0" max="305" name="cantidad_balun" value="<?= isset($_POST['cantidad_balun']) ? $_POST['cantidad_balun'] : 1 ?>">
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

                </tbody>


                <thead>
                    <tr>
                        <td colspan="3">Total</td>
                        <td colspan="1">
                            <span>
                                <?php
                                    $totalGeneral = 0;

                                    if (isset($_POST['producto_dvr']) && isset($_POST['cantidad_dvr'])) {
                                        $totalGeneral += $_POST['producto_dvr'] * $_POST['cantidad_dvr'];
                                    }

                                    if (isset($_POST['producto_camara']) && isset($_POST['cantidad_camara'])) {
                                        $totalGeneral += $_POST['producto_camara'] * $_POST['cantidad_camara'];
                                    }

                                    if (isset($_POST['producto_utp']) && isset($_POST['cantidad_utp'])) {
                                        $totalGeneral += $_POST['producto_utp'] * $_POST['cantidad_utp'];
                                    }

                                    if (isset($_POST['producto_fuentes']) && isset($_POST['cantidad_fuentes'])) {
                                        $totalGeneral += $_POST['producto_fuentes'] * $_POST['cantidad_fuentes'];
                                    }

                                    if (isset($_POST['producto_balun']) && isset($_POST['cantidad_balun'])) {
                                        $totalGeneral += $_POST['producto_balun'] * $_POST['cantidad_balun'];
                                    }

                                    echo "$" . number_format($totalGeneral, 0, ',', '.');

                                ?>
                            </span>
                        </td>
                    </tr>
                </thead>

            </table>

            <button type="submit">Calcular</button>
        </form>



    </main>

    <?php $conexion->close(); ?>
</body>
</html>