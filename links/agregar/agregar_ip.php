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
    <title>Agregar Trabajo IP || L-Red</title>

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
            <h2>Agregar Trabajo IP</h2>
        </section>

        <form action="../../php/subir_trabajo_ip.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>CLIENTE</legend>
                <div>
                    <label for="clientes_id">Cliente <span>(*)</span></label>
                    <select name="clientes_id" id="clientes_id" required>
                        <option value="" selected disabled>Seleccionar Opción</option>
                        <?php
                            $consultation = "SELECT *
                                                FROM clientes
                                                GROUP BY nombre ORDER BY id";
                            $resultado = mysqli_query($conexion,$consultation);
                    
                            while($row = $resultado->fetch_array()){
                                $id       = $row['id'];
                                $nombre   = $row['nombre'];
                                $apellido = $row['apellido'];
                                $razon = $row['razon'];
                
                                ?>
                                    <option value="<?php echo $id ?>">
                                        <?php 
                                        
                                            if (is_string($razon)){
                                                echo $razon;
                                            }else{
                                                echo $nombre . " " . $apellido;
                                            }
                                        
                                        ?>
                                        
                                    </option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <legend>Fecha de trabajo</legend>
                <div>
                    <label for="fecha_trabajo">Fecha <span>(*)</span></label>
                    <input type="date" name="fecha_trabajo" id="fecha_trabajo" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Cámara</legend>
                    <div>
                        <label for="camara_marca">Marca <span>(*)</span></label>
                        <input type="text" name="camara_marca" id="camara_marca" required>
                    </div>
                    <div>
                        <label for="camara_modelo">Modelo <span>(*)</span></label>
                        <input type="text" name="camara_modelo" id="camara_modelo" required>
                    </div>
                    <div>
                        <label for="camara_nombre">Nombre </label>
                        <input type="text" name="camara_nombre" id="camara_nombre">
                    </div>
            </fieldset>

            <fieldset>
                <legend>IP y Puerto</legend>
                    <div>
                        <label for="ip">IP <span>(*)</span></label>
                        <input type="text" name="ip" id="ip" required>
                    </div>
                    <div>
                        <label for="puertos">Puerto<span>(*)</span></label>
                        <input type="number" name="puertos" id="puertos" min=0 required>
                    </div>
            </fieldset>

            <fieldset>
                <legend>FICHAS</legend>
                    <div>
                        <label for="fichas_rj45">Fichas RJ45 <span>(*)</span></label>
                        <input type="number" name="fichas_rj45" id="fichas_rj45" min=0 required>
                    </div>
                    <div>
                        <label for="fichas_plug">Fichas Plug<span>(*)</span></label>
                        <input type="number" name="fichas_plug" id="fichas_plug" min=0 required>
                    </div>
            </fieldset>

            <fieldset>
                <legend>CABLES</legend>
                    <div>
                        <label for="cables_fuentes">Fuentes <span>(*)</span></label>
                        <input type="number" name="cables_fuentes" id="cables_fuentes" min=0 required>
                    </div>
                    <div>
                        <label for="cables_utp">Metros UTP <span>(*)</span></label>
                        <input type="number" name="cables_utp" id="cables_utp" min=0 required>
                    </div>
                    <div>
                        <label for="cables_zapatilla">Zapatilla <span>(*)</span></label>
                        <select name="cables_zapatilla" id="cables_zapatilla" required>
                            <option value="" selected disabled>Seleccionar Opción</option>
                            <option value="Ninguna">Ninguna</option>
                            <option value="4 Tomas">4 Tomas</option>
                            <option value="5 Tomas">5 Tomas</option>
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
                        <label for="acceso_usuario">Usuario</label>
                        <input type="text" name="acceso_usuario" id="acceso_usuario" >
                    </div>
                    <div>
                        <label for="acceso_contraseña">Contraseña</label>
                        <input type="text" name="acceso_contraseña" id="acceso_contraseña">
                    </div>
                    <div>
                        <label for="acceso_host">Hots <span>(*)</span></label>
                        <input type="text" name="acceso_host" id="acceso_host" required>
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
