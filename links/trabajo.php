<?php
    include('../bd/conexion.php');

    if(isset($_GET['id'])){
        $resultado = $conexion -> query ("SELECT * FROM clientes WHERE id=" . $_GET['id'])or die($conexion -> error);
        if(mysqli_num_rows($resultado) > 0){
            $fila = mysqli_fetch_row($resultado);
        }else{
            header("Location: ../index.php");
        }
    }else{
        header("Location: ../index.php");
    }


    
        // Verifica si el usuario está logueado.
    if (!isset($_SESSION['usuario'])) {
        // Si no está logueado, redirige a la página de inicio de sesión.
        header("Location: login.php");
        // exit();
    }else {

        $convertirUsuario = ucwords(strtolower($_SESSION['usuario']));

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
	<!-- META -->
    <?php include('../layout/meta.php');?>

	<!-- TITULO -->
    <title>Trabajo || L-Red</title>

	<!-- ESTILOS -->
    <link rel="stylesheet" href="../css/trabajo.css">

    <!-- ICONOS -->
    <?php include('../layout/iconos.php'); ?>
</head>
<body>
	<!-- CONTENIDO -->
    <main>
        <?php
            if(isset($_GET['id'])){
                $resultado = $conexion -> query (" SELECT
                                                        clientes.id AS clienteID,
                                                        clientes.nombre AS clienteNOMBRE,
                                                        clientes.apellido AS clienteAPELLIDO,
                                                        clientes.razon AS clienteRAZON,
                                                        clientes.localidad AS clienteLOCALIDAD,

                                                        trabajos_cctv.id AS cctvID,
                                                        trabajos_cctv.dvr_marca AS cctvMARCA,
                                                        trabajos_cctv.dvr_modelo AS cctvMODELO,
                                                        trabajos_cctv.dvr_disco AS cctvDISCO,
                                                        trabajos_cctv.dvr_capacidad AS cctvCAPACIDAD,
                                                        trabajos_cctv.dvr_medida AS cctvMEDIDA,
                                                        trabajos_cctv.camaras_cantidad AS cctvCANTIDAD,
                                                        trabajos_cctv.camaras_modelo AS cctvMODELO,
                                                        trabajos_cctv.cables_utp AS cctvUTP,
                                                        
                                                        trabajos_ip.id AS ipID,
                                                        count(trabajos_ip.ip_01) + 
                                                        count(trabajos_ip.ip_02) +
                                                        count(trabajos_ip.ip_03) +
                                                        count(trabajos_ip.ip_04) +
                                                        count(trabajos_ip.ip_05) AS COUNT,
                                                        trabajos_ip.camara_modelo AS ipMODELO,
                                                        
                                                        trabajos_red.id AS redID,
                                                        trabajos_red.observaciones AS redOBSERVACIONES 
                                                    FROM clientes
                                                    LEFT JOIN trabajos_cctv ON clientes.id = trabajos_cctv.clientes_id
                                                    LEFT JOIN trabajos_ip ON clientes.id = trabajos_ip.clientes_id
                                                    LEFT JOIN trabajos_red ON clientes.id = trabajos_red.clientes_id
                                                    WHERE clientes.id=" . $_GET['id'])or die($conexion -> error);
                if(mysqli_num_rows($resultado) > 0){
                    $fila = mysqli_fetch_row($resultado);
                }else{
                    header("Location: ../index.php");
                }
            }else{
                header("Location: ../index.php");
            }
        ?>

        <section>
            <h2>Trabajo N°<?php echo $fila[0]; ?></h2>

            <fieldset>
                <legend>Cliente</legend>

                <div>
                    <?php
                        if (is_string($fila[3])) {
                            echo '<p><span>Razón Social:</span> '. $fila[3] .'</p>';
                        }else{
                            echo '<p><span>Nombre completo:</span> ' .$fila[1].' '.$fila[2]. '</p>';
                        }
                    ?>
                </div>

                <div>
                    <p><span>Lugar:</span> <?php echo $fila[4] ?></p>
                </div>
            </fieldset>

            <fieldset>
                <legend>Trabajo</legend>

                <?php if (is_string($fila[5])) {?>

                <h3>Se realizo:</h3>
                <p>La instalacion de un DVR marca <?php echo $fila[6]?> modelo <?php echo $fila[7]?>, con un disco <?php echo $fila[8]?> de <?php echo $fila[9].$fila[10]?>,
                con <?php echo $fila[11]?> cámaras modelo <?php echo $fila[12]?>.<br>
                Con sus respectivas cajas estancas y sus fichas balun. Para ésta instalación se utilizo <?php echo $fila[13]?> metros de CABLE UTP.</p>

            </fieldset>
                    
            <section>
                <div class="scroll-arrow" id="scroll-left">
                  <i class="fas fa-chevron-left"></i>
                </div>

                <ul id="imgList">
                  <?php
                    $resultado = $conexion->query("SELECT *
                                                        FROM archivos_fotos
                                                        WHERE clientes_id=" . $_GET['id'])or die($conexion->error);


                    while($row = mysqli_fetch_array($resultado)){ ?>
                        <li>
                            <!-- <img src="../files/<?php echo $row['clientes_id'] ?>/img/<?php echo $row['nombre']?>"/> -->
                            <img src="../assets/img/example.jpg"/>
                            <img src="../assets/img/example.jpg"/>
                            <img src="../assets/img/example.jpg"/>
                            <img src="../assets/img/example.jpg"/>
                            <img src="../assets/img/example.jpg"/>
                        </li>
                    <?php }
                  ?>
                </ul>

                <div class="scroll-arrow" id="scroll-right" onclick="scrollRight()">
                  <i class="fas fa-chevron-right"></i>
                </div>

            </section>

            <?php }

                if (is_string($fila[14])){?>
                <h3>Se realizo:</h3>
                <p>La instalación <?php echo $fila[15] ?> cámaras IP marca <?php echo $fila[16]?> en distintos periodos, ya que el trabajo fue se cubrian las necesidades del cliente.<br>
                Se utilizaron 400 metros de cable UTP en total, y además se utilizaron un switch 24 puertos y otro de 8 puertos, para las dichas cámaras y ademas se realizo trabajo estructurado de red para computadoras de escritorio, servidor e impresoras.</p>
            </fieldset>
                    
            <section>
                <div class="scroll-arrow" id="scroll-left">
                  <i class="fas fa-chevron-left"></i>
                </div>

                <ul id="imgList">
                  <?php
                    $resultado = $conexion->query("SELECT *
                                                        FROM archivos_fotos
                                                        WHERE clientes_id=" . $_GET['id'])or die($conexion->error);


                    while($row = mysqli_fetch_array($resultado)){ ?>
                        <li>
                            <img src="../assets/img/<?php echo $row['nombre']?>"/>
                            <img src="../assets/img/<?php echo $row['nombre']?>"/>
                            <img src="../assets/img/<?php echo $row['nombre']?>"/>
                            <img src="../assets/img/<?php echo $row['nombre']?>"/>
                            <img src="../assets/img/<?php echo $row['nombre']?>"/>
                        </li>
                    <?php }
                  ?>
                </ul>

                <div class="scroll-arrow" id="scroll-right" onclick="scrollRight()">
                  <i class="fas fa-chevron-right"></i>
                </div>

            </section>
            
            <?php }

            if (is_string($fila[17])){?>
                <h3>Se realizo:</h3>
                <p><?php echo $fila[18] ?></p>
            </fieldset>

            <section>
                <div class="scroll-arrow" id="scroll-left">
                  <i class="fas fa-chevron-left"></i>
                </div>

                <ul id="imgList">
                  <?php
                    $resultado = $conexion->query("SELECT *
                                                        FROM archivos_fotos
                                                        WHERE clientes_id=" . $_GET['id'])or die($conexion->error);


                    while($row = mysqli_fetch_array($resultado)){ ?>
                        <li>
                            <img src="../assets/img/<?php echo $row['nombre']?>"/>
                            <img src="../assets/img/<?php echo $row['nombre']?>"/>
                            <img src="../assets/img/<?php echo $row['nombre']?>"/>
                            <img src="../assets/img/<?php echo $row['nombre']?>"/>
                            <img src="../assets/img/<?php echo $row['nombre']?>"/>
                        </li>
                    <?php }
                  ?>
                </ul>

                <div class="scroll-arrow" id="scroll-right" onclick="scrollRight()">
                  <i class="fas fa-chevron-right"></i>
                </div>

            </section>

            <?php }?>
            
        </section>

    </main>

	<!-- FOOTER -->
    <?php include('../layout/footer.php');?>

    <script>
        var imgList = document.getElementById('imgList');
        var scrollRight = document.getElementById('scroll-right');
        var scrollLeft = document.getElementById('scroll-left');

      // When a user clicks on the right arrow, the ul will scroll 750px to the right
        scrollRight.addEventListener('click', (event) => {
          imgList.scrollBy(265, 0);
      });

      // When a user clicks on the left arrow, the ul will scroll 750px to the left
        scrollLeft.addEventListener('click', (event) => {
          imgList.scrollBy(-265, 0);
      });
    </script>
</body>
</html>