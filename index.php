<?php
    include('bd/conexion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        include("layout/meta.php");
    ?>
    
    <title>Servicio Técnico</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/index.css">

    <?php
        include("../../layout/iconos.php");
    ?>
</head>
<body>

    <div id="home">
        <i class="fas fa-users-cog"></i>
        <h1>
            SERVICIO TÉCNICO
        </h1>
        <a href="#jobs">
            <i class="fas fa-chevron-down"></i>
        </a>
    </div>

    <div id="jobs">
        <h2 class="title">Trabajos</h2>
        <div class="container">
            <?php
                if($conexion) {
                    $consultation = "SELECT clientes.nombre as NOMBRE,
                                            trabajos_cctv.dvr_marca AS MARCA,
                                            trabajos_cctv.dvr_modelo AS MODELO,
                                            trabajos_cctv.dvr_disco AS DISCO,
                                            trabajos_cctv.dvr_capacidad AS CAPACIDAD,
                                            trabajos_cctv.dvr_medida AS MEDIDA
                                        FROM clientes
                                        INNER JOIN trabajos_cctv 
                                        WHERE clientes.id = trabajos_cctv.clientes_id
                                        ORDER BY NOMBRE
                                        LIMIT 8";

                    $resultado = mysqli_query($conexion,$consultation);
            
                    if($resultado){
                        while($row = $resultado->fetch_array()){
                            $NOMBRE  = $row['NOMBRE'];
                            $MARCA  = $row['MARCA'];
                            $MODELO  = $row['MODELO'];
                            $DISCO  = $row['DISCO'];
                            $CAPACIDAD  = $row['CAPACIDAD'];
                            $MEDIDA  = $row['MEDIDA'];
                            ?>
                                <div class="card">
                                    <img src="assets/img/example.jpg" alt="<?php echo $NOMBRE?>">
                                    <div>
                                        <div class="name">
                                            <?php echo $NOMBRE?>
                                        </div>
                                        <div class="text">
                                            Se instalo un DVR <?php echo $MARCA?>, modelo <?php echo $MODELO?>, con un disco <?php echo $DISCO?> de <?php echo $CAPACIDAD.$MEDIDA?>
                                            <?php ?>
                                        </div>
                                        
                                        <a href="#">Ver</a>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                }
            ?>

            <?php
                if($conexion) {
                    $consultation = "SELECT clientes.nombre as NOMBRE,
                                            trabajos_ip.camara_modelo AS CAMARA,
                                            COUNT(ip_01) + COUNT(ip_02) + COUNT(ip_03) +COUNT(ip_04) +COUNT(ip_05) AS CANTIDAD
                                        FROM clientes
                                        INNER JOIN trabajos_ip
                                        WHERE clientes.id = trabajos_ip.clientes_id
                                        LIMIT 3";

                    $resultado = mysqli_query($conexion,$consultation);
            
                    if($resultado){
                        while($row = $resultado->fetch_array()){
                            $NOMBRE  = $row['NOMBRE'];
                            $CAMARA  = $row['CAMARA'];
                            $CANTIDAD  = $row['CANTIDAD'];
                            ?>
                                <div class="card">
                                    <img src="assets/img/example.jpg" alt="<?php echo $NOMBRE?>">
                                    <div>
                                        <div class="name">
                                            <?php echo $NOMBRE?>
                                        </div>
                                        <div class="text">
                                            Se instalaron <?php echo $CANTIDAD ?> cámaras IP marca <?php echo $CAMARA?>
                                            <?php ?>
                                        </div>
                                        
                                        <a href="#">Ver</a>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                }
            ?>
        </div>
    </div>

    <div id="contact">
        <h2 class="title">Contacto</h2>
            <div class="wrapper">
                <form action="php/enviar_correo.php" method="POST">
                    <h3>Consulta</h3>
                    <div class="field">
                        <input type="text" required id="nombre" name="nombre">
                        <label for="nombre">Nombre completo (*)</label>
                    </div>
                    <div class="field">
                        <input type="text" required id="correo" name="correo">
                        <label for="correo">Email (*)</label>
                    </div>
                    <div class="field">
                        <input type="tel" required id="celular" name="celular">
                        <label for="celular">Celular (*)</label>
                    </div>
                    <div class="field">
                        <input type="text" required id="mensaje" name="mensaje">
                        <label for="mensaje">Mensaje (*)</label>
                    </div>
                    <button type="submit">Enviar</button>
                    <span> (*) Campos obligatorios</span>
                </form>
            </div>
    </div>

    <div id="redes">
        <h3>Seguinos en: </h3>
        <div>
            <a href="http://facebook.com" target="_blank">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="https://wa.me/5491176145568" target="_blank">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
        </div>
    </div>

    <?php
        include("layout/footer.php");
    ?>

</body>
</html>