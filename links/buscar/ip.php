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
    <title>Trabajo IP || L-Red</title>

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
                $resultado = $conexion -> query ("SELECT clientes.id,
                                                            clientes.nombre,
                                                            clientes.apellido,
                                                            clientes.razon,
                                                            
                                                            trabajos_ip.*,
                                                            
                                                            trabajos_ip_detalles.ip,
                                                            trabajos_ip_detalles.puertos,
                                                            trabajos_ip_detalles.camara_nombre
                                                    FROM clientes
                                                    JOIN trabajos_ip ON trabajos_ip.clientes_id = clientes.id
                                                    JOIN trabajos_ip_detalles ON trabajos_ip_detalles.clientes_id = trabajos_ip.clientes_id
                                                    WHERE trabajos_ip.clientes_id=" . $_GET['id'] . " GROUP BY trabajos_ip_detalles.camara_nombre")or die($conexion -> error);

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
                <legend>Cámara</legend>
                    <div>
                        <label for="camara_marca">Marca</label>
                        <input type="text" id="camara_marca" value="<?php echo $fila[6] ?>" disabled>
                    </div>
                    <div>
                        <label for="camara_modelo">Modelo</label>
                        <input type="text" id="camara_modelo" value="<?php echo $fila[7] ?>" disabled>
                    </div>
            </fieldset>

            <fieldset>
                <legend>Nombre, IP y Puertos</legend>
                    <?php 
                        if(!empty($fila[26])) {
                            while ($row = $resultado->fetch_assoc()) {
                                ?>
                                    <div class="bucle">
                                        <label><?php echo $row['camara_nombre']; ?></label>
                                        <div>
                                            <input type="text" value="<?php echo $row['ip']; ?>" disabled>
                                            <input type="text" value="<?php echo $row['puertos']; ?>" disabled>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    ?>
            </fieldset>

            <fieldset>
                <legend>FICHAS</legend>
                <?php 
                    if(!empty($fila[9])){
                        $resultado = $conexion -> query ("SELECT SUM(fichas_rj45) AS FICHASRJ45, SUM(fichas_plug) AS FICHASPLUG
                                                            FROM trabajos_ip
                                                            WHERE trabajos_ip.clientes_id=" . $_GET['id'])or die($conexion -> error);

                        if(mysqli_num_rows($resultado) > 0){
                            $fichas = mysqli_fetch_row($resultado);
                        }?>

                            <div>
                                <label>Fichas RJ45</label>
                                <input type="text" value="<?php echo $fichas[0]; ?>" disabled>
                            </div>
                            <div>
                                <label for="fichas_plug">Fichas Plug</label>
                                <input type="text" value="<?php echo $fichas[1]; ?>" disabled>
                            </div>

                   <?php }
                ?>
            </fieldset>

            <fieldset>
                <legend>CABLES</legend>
                <?php 
                    if(!empty($fila[10])){
                        $resultado = $conexion -> query ("SELECT SUM(cables_fuentes), SUM(cables_utp), SUM(cables_zapatilla)
                                                            FROM trabajos_ip
                                                            WHERE trabajos_ip.clientes_id=" . $_GET['id'])or die($conexion -> error);

                        if(mysqli_num_rows($resultado) > 0){
                            $fichas = mysqli_fetch_row($resultado);
                        }?>

                            <div>
                                <label>Fuentes</label>
                                <input type="number" value="<?php echo $fichas[0]; ?>" disabled>
                            </div>
                            <div>
                                <label for="cables_utp">Metros UTP</label>
                                <input type="number" value="<?php echo $fichas[1]; ?>" disabled>
                            </div>
                            <div>
                                <label for="cables_zapatilla">Zapatilla</label>
                                <input type="number" value="<?php echo $fichas[2]; ?>" disabled>
                            </div>
                        
                   <?php }
                ?>
            </fieldset>

            <fieldset>
                <legend>INSUMOS</legend>
                <?php 
                    if(!empty($fila[9])){
                        $resultado = $conexion -> query ("SELECT SUM(insumos_tar6),
                                                                    SUM(insumos_tor6),
                                                                    SUM(insumos_tar8),
                                                                    SUM(insumos_tor8),
                                                                    SUM(insumos_gra8),
                                                                    SUM(insumos_prec)
                                                            FROM trabajos_ip
                                                            WHERE trabajos_ip.clientes_id=" . $_GET['id'])or die($conexion -> error);

                        if(mysqli_num_rows($resultado) > 0){
                            $fichas = mysqli_fetch_row($resultado);
                        }?>

                            <div>
                                <label>Tarugos 6mm</label>
                                <input type="number" value="<?php echo $fichas[0]; ?>" disabled>
                            </div>
                            <div>
                                <label>Tornillos 6mm</label>
                                <input type="number" value="<?php echo $fichas[1]; ?>" disabled>
                            </div>
                            <div>
                                <label>Tarugos 8mm</label>
                                <input type="number" value="<?php echo $fichas[2]; ?>" disabled>
                            </div>
                            <div>
                                <label>Tornillos 8mm</label>
                                <input type="number" value="<?php echo $fichas[3]; ?>" disabled>
                            </div>
                            <div>
                                <label>Grampas 8mm</label>
                                <input type="number" value="<?php echo $fichas[4]; ?>" disabled>
                            </div>
                            <div>
                                <label>Precintos</label>
                                <input type="number" value="<?php echo $fichas[5]; ?>" disabled>
                            </div>
                        
                   <?php }
                ?>
            </fieldset>

            <fieldset>
                <legend>ACCESO</legend>
                    <div>
                        <label>Usuario</label>
                        <input type="text" value="<?php echo $fila[20] ?>" disabled>
                    </div>
                    <div>
                        <label>Contraseña</label>
                        <input type="text" value="<?php echo $fila[21] ?>" disabled>
                    </div>
                    <div>
                        <label>Hots</label>
                        <input type="text" value="<?php echo $fila[22] ?>" disabled>
                    </div>
            </fieldset>

            <fieldset>
                <legend>Observaciones</legend>
                <div>
                    <textarea type="text" disabled><?php echo $fila[23] ?></textarea>
                </div>
            </fieldset>
        </form>
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
            }
        
        
        } ?>
    
    </main>
    
    
    <script src="../../js/main.js"></script>
</body>
</html>