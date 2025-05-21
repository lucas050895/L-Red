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

        // SE REDIRECCIONA SI SE INGRESA UN ID QUE NO EXISTE
        $resultado = $conexion -> query ("SELECT * FROM trabajos_ip WHERE clientes_id=" . $_GET['id'])or die($conexion -> error);
        if(mysqli_num_rows($resultado) > 0){
            $fila = mysqli_fetch_row($resultado);
        }else{
            header("Location: http://lucasconde.ddns.net/L-Red/links/buscar/buscar_ip.php");
        }


    
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
                $resultado = $conexion -> query ("SELECT 
                                                        clientes.id,
                                                        clientes.nombre,
                                                        clientes.apellido,
                                                        clientes.razon,

                                                        trabajos_ip.*,
                                                        
                                                        trabajos_ip_detalles.ip,
                                                        trabajos_ip_detalles.puertos,
                                                        trabajos_ip_detalles.camara_nombre
                                                    FROM Clientes
                                                    LEFT JOIN  Trabajos_ip ON Clientes.ID = Trabajos_ip.CLIENTES_ID
                                                    LEFT JOIN Trabajos_ip_detalles ON Trabajos_ip.ID = Trabajos_ip_detalles.TRABAJOS_IP_ID
                                                    WHERE trabajos_ip.clientes_id = " . $_GET['id'])or die($conexion -> error);

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
                        <input type="text" id="camara_marca" value="<?php echo $fila[7] ?>" disabled>
                    </div>
                    <div>
                        <label for="camara_modelo">Modelo</label>
                        <input type="text" id="camara_modelo" value="<?php echo $fila[8] ?>" disabled>
                    </div>
            </fieldset>

            <fieldset>
                <legend>Nombre - IP - Puerto</legend>
                <?php
                    // Consulta SQL
                    $sql = "SELECT *
                                FROM Trabajos_ip_detalles
                                INNER JOIN trabajos_ip ON trabajos_ip_detalles.trabajos_ip_id = Trabajos_ip.id
                                WHERE trabajos_ip.clientes_id = " . $_GET['id'] . " ORDER BY Trabajos_ip_detalles.camara_nombre";
                    $resultado = $conexion->query($sql);

                    if ($resultado->num_rows > 0) {
                        // Recuperar todos los registros
                        $rows = $resultado->fetch_all(MYSQLI_ASSOC);

                        foreach ($rows as $row) {
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
                    if(!empty($fila[10])){
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
                    if(!empty($fila[11])){
                        $resultado = $conexion -> query ("SELECT SUM(cables_fuentes), SUM(cables_utp), cables_zapatilla
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
                    if(!empty($fila[10])){
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
                        <input type="text" value="<?php echo $fila[21] ?>" disabled>
                    </div>
                    <div>
                        <label>Contraseña</label>
                        <input type="text" value="<?php echo $fila[22] ?>" disabled>
                    </div>
                    <div>
                        <label>Hots</label>
                        <input type="text" value="<?php echo $fila[23] ?>" disabled>
                    </div>
            </fieldset>

            <fieldset>
                <legend>Observaciones</legend>
                <div>
                    <textarea type="text" disabled><?php echo $fila[24] ?></textarea>
                </div>
            </fieldset>
        </form>

        <?php
            if (is_dir('../../files/' . $fila[0] . '/' . $fila[6] . '/pdf/')) {
                echo '<div id="container_doc">';

                // Consulta segura de la base de datos
                $sql = "SELECT * FROM archivos_pdf WHERE clientes_id = " . intval($fila[0]);
                $resultado = $conexion->query($sql);

                // Verificar si hay resultados
                if ($resultado && $resultado->num_rows > 0) {
                    while ($fila_archivo = $resultado->fetch_assoc()) {
                        // Construcción segura del `src`
                        echo '<iframe src="../../files/' . htmlspecialchars($fila[0]) . '/' . htmlspecialchars($fila[6]) . '/pdf/' . htmlspecialchars($fila_archivo['nombre']) . '" 
                                type="application/pdf" 
                                width="500px" 
                                height="400px">
                            </iframe>';
                    }
                }

                echo '</div>';
            }
        } ?>
    
    </main>
    
    
    <script src="../../js/main.js"></script>
</body>
</html>