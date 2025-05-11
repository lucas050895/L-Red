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
    <title>Agregar Trabajo CCTV || L-Red</title>

    <!-- STYLES -->
    <link rel="stylesheet" href="../../css/general.css">

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
            <h2>Agregar Trabajo CCTV</h2>
        </section>

        <form action="../../php/subir_trabajo_cctv.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>CLIENTE</legend>
                <div>
                    <label for="clientes_id">Cliente <span>(*)</span></label>
                    <select name="clientes_id" id="clientes_id" required>
                        <option value="" selected disabled>Seleccionar Opción</option>
                        <?php
                            if($conexion) {
                                $consultation = "SELECT *
                                                    FROM clientes
                                                    ORDER BY nombre";
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
            </fieldset>

            <fieldset>
                <legend>DVR</legend>
                    <div>
                        <label for="dvr_marca">Marca <span>(*)</span></label>
                        <input type="text" name="dvr_marca" id="dvr_marca" required>
                    </div>
                    <div>
                        <label for="dvr_modelo">Modelo <span>(*)</span></label>
                        <input type="text" name="dvr_modelo" id="dvr_modelo" required>
                    </div>
                    <div>
                        <label for="dvr_disco">Disco <span>(*)</span></label>
                        <select name="dvr_disco" id="dvr_disco" required>
                            <option value="" selected disabled>Seleccionar Opción</option>
                            <option value="HDD">HDD</option>
                            <option value="SDD">SDD</option>
                            <option value="Ninguno">Ninguno</option>
                        </select>
                    </div>
                    <div>
                        <label for="dvr_capacidad">Capacidad</label>
                        <input type="number" name="dvr_capacidad" id="dvr_capacidad" min=0>
                    </div>
                    <div>
                        <label for="dvr_medida">Medida <span>(*)</span></label>
                        <select name="dvr_medida" id="dvr_medida" required>
                            <option value="" selected disabled>Seleccionar Opción</option>
                            <option value="GB">GB</option>
                            <option value="TB">TB</option>
                        </select>
                    </div>
            </fieldset>

            <fieldset>
                <legend>CÁMARAS</legend>
                    <div>
                        <label for="camaras_cantidad">Cantidad <span>(*)</span></label>
                        <input type="number" name="camaras_cantidad" id="camaras_cantidad" min=0 required>
                    </div>
                    <div>
                        <label for="camaras_modelo">Modelo <span>(*)</span></label>
                        <input type="text" name="camaras_modelo" id="camaras_modelo" required>
                    </div>
                    <div>
                        <label for="camaras_caja">Caja Estanca <span>(*)</span></label>
                        <select name="camaras_caja" id="camaras_caja" required>
                            <option value="" selected disabled>Seleccionar Opción</option>
                            <option value="9CM">9CM</option>
                            <option value="11CM">11CM</option>
                        </select>
                    </div>
            </fieldset>

            <fieldset>
                <legend>FICHAS</legend>
                    <div>
                        <label for="fichas_balum">Balum <span>(*)</span></label>
                        <select name="fichas_balum" id="fichas_balum" required>
                            <option value="" selected disabled>Seleccionar Opción</option>
                            <option value="presion"> Balum Presión</option>
                            <option value="rj45">Balum RJ45</option>
                        </select>
                    </div>
                    <div>
                        <label for="fichas_rj45">Fichas RJ45 <span>(*)</span></label>
                        <input type="number" name="fichas_rj45" id="fichas_rj45" min=0 required>
                    </div>
            </fieldset>

            <fieldset>
                <legend>CABLES</legend>
                    <div>
                        <label for="cables_utp">Metros UTP <span>(*)</span></label>
                        <input type="number" name="cables_utp" id="cables_utp" min=0 required>
                    </div>
                    <div>
                        <label for="cables_patch">Cable Patch <span>(*)</span></label>
                        <select name="cables_patch" id="cables_patch" required>
                            <option value="" selected disabled>Seleccionar Opción</option>
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div>
                        <label for="cables_zapatilla">Zapatilla <span>(*)</span></label>
                        <select name="cables_zapatilla" id="cables_zapatilla" required>
                            <option value="" selected disabled>Seleccionar Opción</option>
                            <option value="ninguna">Ninguna</option>
                            <option value="4 tomas">4 Tomas</option>
                            <option value="5 tomas">5 Tomas</option>
                        </select>
                    </div>
                    <div>
                        <label for="cables_fuente">Fuente <span>(*)</span></label>
                        <select name="cables_fuente" id="cables_fuente" required>
                            <option value="" selected disabled>Seleccionar Opción</option>
                            <option value="individual">Individual</option>
                            <option value="swicht">Swicht</option>
                            <option value="ambos">Ambos</option>
                        </select>
                    </div>
                    <div>
                        <label for="cables_pulpito">Pulpito <span>(*)</span></label>
                        <select name="cables_pulpito" id="cables_pulpito" required>
                            <option value="" selected disabled>Seleccionar Opción</option>
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div>
                        <label for="cables_hdmi">Cable HDMI <span>(*)</span></label>
                        <select name="cables_hdmi" id="cables_hdmi" required>
                            <option value="" selected disabled>Seleccionar Opción</option>
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
            </fieldset>

            <fieldset>
                <legend>INSUMOS</legend>
                    <div>
                        <label for="insumos_tar6">Tarugos 6mm</label>
                        <input type="number" name="insumos_tar6" id="insumos_tar6" min=0>
                    </div>
                    <div>
                        <label for="insumos_tor6">Tornillos 6mm</label>
                        <input type="number" name="insumos_tor6" id="insumos_tor6" min=0>
                    </div>
                    <div>
                        <label for="insumos_tar8">Tarugos 8mm</label>
                        <input type="number" name="insumos_tar8" id="insumos_tar8" min=0>
                    </div>
                    <div>
                        <label for="insumos_tor8">Tornillos 8mm</label>
                        <input type="number" name="insumos_tor8" id="insumos_tor8" min=0>
                    </div>
                    <div>
                        <label for="insumos_gra8">Grampas 8mm</label>
                        <input type="number" name="insumos_gra8" id="insumos_gra8" min=0>
                    </div>
                    <div>
                        <label for="insumos_prec">Precintos</label>
                        <input type="number" name="insumos_prec" id="insumos_prec" min=0>
                    </div>
            </fieldset>

            <fieldset>
                <legend>ACCESO</legend>
                    <div>
                        <label for="acceso_usuario">Usuario <span>(*)</span></label>
                        <input type="text" name="acceso_usuario" id="acceso_usuario" required>
                    </div>
                    <div>
                        <label for="acceso_contraseña">Contraseña <span>(*)</span></label>
                        <input type="text" name="acceso_contraseña" id="acceso_contraseña" required>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Observaciones</legend>
                <div>
                    <textarea id="observaciones" name="observaciones"></textarea>
                </div>
            </fieldset>

            <div class="container_field">
                <p><span>(*)</span> Campos obligatorios</p>
            </div>

            <div class="container_button">
                <input type="submit" name="submit" value="CARGAR">
            </div>
        </form>
    </main>


    <script src="../../js/main.js"></script>
</body>
</html>
