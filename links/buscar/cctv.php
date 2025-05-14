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
    <title>Trabajo CCTV || L-Red</title>

    <!-- STYLES -->
    <link rel="stylesheet" href="../../css/cliente.css">

    <?php
        include("../../layout/iconos.php");
    ?>
</head>
<body>
    <main>
        <?php
            include("../../layout/nav.php");
        ?>

        <?php
            if(isset($_GET['id'])){
                $resultado = $conexion -> query ("SELECT *
                                                    FROM clientes
                                                    INNER JOIN trabajos_cctv ON clientes.id = trabajos_cctv.clientes_id
                                                    WHERE clientes.id=" . $_GET['id'])or die($conexion -> error);

                if(mysqli_num_rows($resultado) > 0){
                    $fila = mysqli_fetch_row($resultado);

                }
        ?>

        <section class="title">
            <i class='bx bxs-user-detail'></i>
            <h2>Cliente N° <?php echo $fila[0] . "<br>" ?>

                <?php if ($fila[3]) {
                    echo $fila[3];
                }else{
                    echo $fila[1] . " " . $fila[2];
                } ?>
            </h2>
        </section>

        <form action="">
            <fieldset>
                <legend>DVR</legend>
                    <div>
                        <label for="dvr_marca">Marca</label>
                        <input type="text" id="dvr_marca" value="<?php echo $fila[12] ?>" disabled>
                    </div>
                    <div>
                        <label for="dvr_modelo">Modelo </label>
                        <input type="text" id="dvr_modelo" value="<?php echo $fila[13] ?>" disabled>
                    </div>
                    <div>
                        <label for="dvr_disco">Disco</label>
                        <input type="text" id="dvr_disco" value="<?php echo $fila[14] ?>" disabled>
                    </div>
                    <div>
                        <label for="dvr_capacidad">Capacidad</label>
                        <input type="text"  id="dvr_capacidad" value="<?php echo $fila[15] ?>" disabled>
                    </div>
                    <div>
                        <label for="dvr_medida">Medida</label>
                        <input type="text" id="dvr_medida" value="<?php echo $fila[16] ?>" disabled>
                    </div>
            </fieldset>
            
            <fieldset>
                <legend>CÁMARAS</legend>
                    <div>
                        <label for="camaras_cantidad">Cantidad </label>
                        <input type="text" id="camaras_cantidad" value="<?php echo $fila[17] ?>" disabled>
                    </div>
                    <div>
                        <label for="camaras_modelo">Modelo</label>
                        <input type="text" id="camaras_modelo" value="<?php echo $fila[18] ?>" disabled>
                    </div>
                    <div>
                        <label for="camaras_caja">Caja Estanca</label>
                        <input type="text" id="camaras_caja" value="<?php echo $fila[19] ?>" disabled>
                    </div>
            </fieldset>

             <fieldset>
                <legend>FICHAS</legend>
                    <div>
                        <label for="fichas_balum">Balum</label>
                        <input type="text" id="fichas_balum" value="<?php echo $fila[20] ?>" disabled>
                    </div>
                    <div>
                        <label for="fichas_rj45">Fichas RJ45</label>
                        <input type="text" id="fichas_rj45" value="<?php echo $fila[21] ?>" disabled>
                    </div>
            </fieldset>

            <fieldset>
                <legend>CABLES</legend>
                    <div>
                        <label for="cables_utp">Metros UTP</label>
                        <input type="text" id="cables_utp" value="<?php echo $fila[22] ?>" disabled>
                    </div>
                    <div>
                        <label for="cables_patch">Cable Patch </label>
                        <input type="text" id="cables_patch" value="<?php echo $fila[23] ?>" disabled>
                    </div>
                    <div>
                        <label for="cables_zapatilla">Zapatilla</label>
                        <input type="text" id="cables_zapatilla" value="<?php echo $fila[24] ?>" disabled>
                    </div>
                    <div>
                        <label for="cables_fuente">Fuente</label>
                        <input type="text" id="cables_fuente" value="<?php echo $fila[25] ?>" disabled>
                    </div>
                    <div>
                        <label for="cables_pulpito">Pulpito</label>
                        <input type="text" id="cables_pulpito" value="<?php echo $fila[26] ?>" disabled>
                    </div>
                    <div>
                        <label for="cables_hdmi">Cable HDMI </label>
                        <input type="text" id="cables_hdmi" value="<?php echo $fila[27] ?>" disabled>
                    </div>
            </fieldset>

            <fieldset>
                <legend>INSUMOS</legend>
                    <div>
                        <label for="insumos_tar6">Tarugos 6mm</label>
                        <input type="text" id="insumos_tar6" value="<?php echo $fila[28] ?>" disabled>
                    </div>
                    <div>
                        <label for="insumos_tor6">Tornillos 6mm</label>
                        <input type="text" id="insumos_tor6" value="<?php echo $fila[29] ?>" disabled>
                    </div>
                    <div>
                        <label for="insumos_tar8">Tarugos 8mm</label>
                        <input type="text" id="insumos_tar8" value="<?php echo $fila[30] ?>" disabled>
                    </div>
                    <div>
                        <label for="insumos_tor8">Tornillos 8mm</label>
                        <input type="text" id="insumos_tor8" value="<?php echo $fila[31] ?>" disabled>
                    </div>
                    <div>
                        <label for="insumos_gra8">Grampas 8mm</label>
                        <input type="text" id="insumos_gra8" value="<?php echo $fila[32] ?>" disabled>
                    </div>
                    <div>
                        <label for="insumos_prec">Precintos</label>
                        <input type="text" id="insumos_prec" value="<?php echo $fila[33] ?>" disabled>
                    </div>
            </fieldset>

            <fieldset>
                <legend>ACCESO</legend>
                    <div>
                        <label for="acceso_usuario">Usuario</label>
                        <input type="text" name="acceso_usuario" id="acceso_usuario" value="<?php echo $fila[34] ?>" disabled>
                    </div>
                    <div>
                        <label for="acceso_contraseña">Contraseña</label>
                        <input type="text" name="acceso_contraseña" id="acceso_contraseña" value="<?php echo $fila[35] ?>" disabled>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Observaciones</legend>
                <div>
                    <textarea id="observaciones" value="<?php echo $fila[36] ?>" disabled></textarea>
                </div>
            </fieldset>
        </form>

        <?php
            if(is_dir('../../files/'.$fila[0].'/pdf/')){
                ?>
                    <div id="container_doc">
                        <?php
                            $sql = "SELECT * FROM archivos_pdf WHERE clientes_id = ".$fila[0];
                            $resultado = $conexion->query($sql);
                            // Mostrar resultados
                            if ($resultado->num_rows > 0) {
                                while ($fila = $resultado->fetch_assoc()) {
                                    ?>
                                        <iframe src="../<?php echo $fila['ruta'] . $fila['nombre']; ?>" type="application/x-google-chrome-pdf" max-width="500px" max-height="400px">
                                        </iframe>
                                    <?php
                                }
                            }
                        ?>  
                    </div>
                <?php
            };
        
        
        } ?>
    
    </main>
    
    
    <script src="../../js/main.js"></script>
</body>
</html>