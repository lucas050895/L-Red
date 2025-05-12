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
    <title>Trabajo RED || L-Red</title>

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
                                                        
                                                        trabajos_red.*
                                                    FROM clientes
                                                    JOIN trabajos_red ON trabajos_red.clientes_id = clientes.id
                                                    WHERE trabajos_red.clientes_id=" . $_GET['id'])or die($conexion -> error);

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
                <legend>Equipo</legend>
                    <div>
                        <label>Tipo de Equipo</label>
                        <input type="text" value="<?php echo $fila[6] ?>" disabled>
                    </div>
                    <div>
                        <label>Modelo</label>
                        <?php
                            if(!is_string($fila[7])){?>
                                <input type="text" value="<?php echo $fila[7] ?>" disabled>
                            <?php }else{?>
                                <input type="text" value="-" disabled>
                            <?php }
                        ?>
                    </div>
            </fieldset>

            <fieldset>
                <legend>CABLES</legend>
                    <div>
                        <label>Metros UTP</label>
                        <input type="number" value="<?php echo $fila[8] ?>" disabled>
                    </div>
                    <div>
                        <label>Metros PAR</label>
                        <input type="number" value="<?php echo $fila[9] ?>" disabled>
                    </div>
            </fieldset>

            <fieldset>
                <legend>FICHAS</legend>
                    <div>
                        <label for="fichas_rj45">Fichas RJ45</label>
                        <input type="number" value="<?php echo $fila[10] ?>" disabled>
                    </div>
                    <div>
                        <label>Fichas Empalme</label>
                        <input type="number" value="<?php echo $fila[11] ?>" disabled>
                    </div>
            </fieldset>

            <fieldset>
                <legend>RACK</legend>
                    <div>
                        <label>Tipo de Rack</label>
                        <?php
                            if(!is_string($fila[12])){?>
                                <input type="text" value="<?php echo $fila[12] ?>" disabled>
                            <?php }else{?>
                                <input type="text" value="-" disabled>
                            <?php }
                        ?>
                    </div>
            </fieldset>

            <fieldset>
                <legend>INSUMOS</legend>
                    <div>
                        <label>Tarugos 6mm</label>
                        <input type="number" value="<?php echo $fila[13] ?>" disabled>
                    </div>
                    <div>
                        <label>Tornillos 6mm</label>
                        <input type="number" value="<?php echo $fila[14] ?>" disabled>
                    </div>
                    <div>
                        <label>Tarugos 8mm</label>
                        <input type="number" value="<?php echo $fila[15] ?>" disabled>
                    </div>
                    <div>
                        <label>Tornillos 8mm</label>
                        <input type="number" value="<?php echo $fila[16] ?>" disabled>
                    </div>
                    <div>
                        <label>Grampas 8mm</label>
                        <input type="number" value="<?php echo $fila[17] ?>" disabled>
                    </div>
                    <div>
                        <label>Precintos</label>
                        <input type="number" value="<?php echo $fila[18] ?>" disabled>
                    </div>
            </fieldset>

            <fieldset>
                <legend>Observaciones</legend>
                <div>
                    <textarea type="text" disabled><?php echo $fila[19] ?></textarea>
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
            }
        
        
        } ?>
    
    </main>
    
    
    <script src="../../js/main.js"></script>
</body>
</html>