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
    <title>Agregar Trabajo de Red || L-Red</title>

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
            <h2>Agregar Trabajo de Red</h2>
        </section>

        <form action="../../php/subir_trabajo_red.php" method="POST" enctype="multipart/form-data">
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
                <legend>Equipo</legend>
                    <div>
                        <label for="equipo_tipo">Tipo de Equipo</label>
                        <select name="equipo_tipo" id="equipo_tipo">
                            <option value="" selected disabled>Seleccionar Opción</option>
                            <option value="Ninguno">Ninguno</option>
                            <option value="TP-Link">TP-Link</option>
                            <option value="Propio">Propio</option>
                            <option value="Switch 8">Switch 8</option>
                            <option value="Switch 16">Switch 16</option>
                            <option value="Switch 24">Switch 24</option>
                        </select>
                    </div>
                    <div>
                        <label for="equipo_modelo">Modelo</label>
                        <input type="text" name="equipo_modelo" id="equipo_modelo">
                    </div>
            </fieldset>

            <fieldset>
                <legend>CABLES</legend>
                    <div>
                        <label for="cables_utp">Metros UTP <span>(*)</span></label>
                        <input type="number" name="cables_utp" id="cables_utp" min=0 required>
                    </div>
                    <div>
                        <label for="cables_par">Metros PAR</label>
                        <input type="number" name="cables_par" id="cables_par" min=0>
                    </div>
            </fieldset>

            <fieldset>
                <legend>FICHAS</legend>
                    <div>
                        <label for="fichas_rj45">Fichas RJ45 <span>(*)</span></label>
                        <input type="number" name="fichas_rj45" id="fichas_rj45" min=0 required>
                    </div>
                    <div>
                        <label for="fichas_empalme">Fichas Empalme</label>
                        <input type="number" name="fichas_empalme" id="fichas_empalme" min=0>
                    </div>
            </fieldset>

            <fieldset>
                <legend>RACK</legend>
                    <div>
                        <label for="rack">Tipo de Rack</label>
                        <select name="rack" id="rack">
                            <option value="" selected disabled>Seleccionar Opción</option>
                            <option value="Ninguno">Ninguno</option>
                            <option value="Plastico">Plástico</option>
                            <option value="Metalico">Metálico</option>
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
