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
        include("layout/iconos.php");
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
                    $consultation = "SELECT clientes.id AS clientesID,
                                            clientes.nombre AS clientesNOMBRE,
                                            clientes.razon AS clientesRAZON,
                                            
                                            trabajos_cctv.id AS cctvID,
                                            trabajos_cctv.dvr_marca AS cctvMARCA,
                                            trabajos_cctv.dvr_modelo AS cctvMODELO,
                                            trabajos_cctv.dvr_disco AS cctvDISCO,
                                            trabajos_cctv.dvr_capacidad AS cctvCAPACIDAD,
                                            trabajos_cctv.dvr_medida AS cctvMEDIDA,
                                            
                                            trabajos_ip.id AS ipID,
                                            trabajos_ip.camara_modelo AS ipCAMARA,
                                            COUNT(ip_01) + COUNT(ip_02) + COUNT(ip_03) + COUNT(ip_04) + COUNT(ip_05) AS ipCANTIDAD
                                            
                                    FROM clientes
                                    LEFT JOIN trabajos_cctv ON clientes.id = trabajos_cctv.clientes_id
                                    LEFT JOIN trabajos_ip ON clientes.id = trabajos_ip.clientes_id
                                    -- PARA AGREGAR IF DE RED
                                    LEFT JOIN trabajos_red ON clientes.id = trabajos_red.clientes_id
                                    GROUP BY nombre
                                    LIMIT 8";

                    $resultado = mysqli_query($conexion,$consultation);
            
                    if($resultado){
                        while($row = $resultado->fetch_array()){
                            $clientesID         = $row['clientesID'];
                            $clientesNOMBRE     = $row['clientesNOMBRE'];
                            $clientesRAZON      = $row['clientesRAZON'];

                            $cctvID             = $row['cctvID'];
                            $cctvMARCA          = $row['cctvMARCA'];
                            $cctvMODELO         = $row['cctvMODELO'];
                            $cctvDISCO          = $row['cctvDISCO'];
                            $cctvCAPACIDAD      = $row['cctvCAPACIDAD'];
                            $cctvMEDIDA         = $row['cctvMEDIDA'];

                            $ipID               = $row['ipID'];
                            $ipCAMARA           = $row['ipCAMARA'];
                            $ipCANTIDAD         = $row['ipCANTIDAD'];




                            if (is_string($cctvID)){ ?>
                                <div class="card">
                                    <div>
                                        <img src="assets/img/example.jpg" alt="<?php echo $clientesNOMBRE?>">
                                    </div>
                                    <div>
                                        <div class="name">
                                            <?php 
                                                if (is_string($clientesRAZON)){
                                                    echo $clientesRAZON;
                                                }else{
                                                    echo $clientesNOMBRE;
                                                }
                                            ?>
                                        </div>
                                        <div class="text">
                                            Se instalo un DVR <?php echo $cctvMARCA?>, modelo <?php echo $cctvMODELO?>, con un disco <?php echo $cctvDISCO?> de <?php echo $cctvCAPACIDAD.$cctvMEDIDA?>
                                            <?php ?>
                                        </div>
                                        
                                        <a href="http://lucasconde.ddns.net/L-Red/links/trabajo.php?id=<?php echo $clientesID ?>">Ver</a>
                                    </div>
                                </div>
                            <?php }


                            if (is_string($ipID)){ ?>
                                <div class="card">
                                    <div>
                                        <img src="assets/img/example.jpg" alt="<?php echo $NOMBRE?>">
                                    </div>
                                    <div>
                                        <div class="name">
                                            <?php 
                                                if (is_string($clientesRAZON)){
                                                    echo $clientesRAZON;
                                                }else{
                                                    echo $clientesNOMBRE;
                                                }
                                            ?>
                                        </div>
                                        <div class="text">
                                            Se instalaron <?php echo $ipCANTIDAD ?> cámaras IP marca <?php echo $ipCAMARA?>
                                            <?php ?>
                                        </div>
                                        
                                        <a href="http://lucasconde.ddns.net/L-Red/links/trabajo.php?id=<?php echo $clientesID ?>">Ver</a>
                                    </div>
                                </div>
                            <?php }
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