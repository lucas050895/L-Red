<?php
    include('../../bd/conecxion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head> 
    <!-- CHARSET -->
    <meta charset="UTF-8">
    <!-- IE-EDGE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- VIEWPORT -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- DESCRIPTION -->
    <meta name="description" content="L-Red">
    <!-- AUTHOR -->
    <meta name="author" content="Lucas Conde">
    <!-- TITTLE -->
    <title>Cliente || L-Red</title>
    <!-- STYLES -->
    <link rel="stylesheet" href="../../css/cliente.css">

    <!-- BOXICONS  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/439ee37b3b.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <?php
            include("../../layout/nav.php");
        ?>

        <?php
            if(isset($_GET['id'])){
                $resultado = $conexion -> query ("SELECT * FROM clientes WHERE id=" . $_GET['id'])or die($conexion -> error);
                if(mysqli_num_rows($resultado) > 0){
                    $fila = mysqli_fetch_row($resultado);

                }else{
                    header("Location: ../subir/cliente_subido.php");
                }
            }else{
                header("Location: ../subir/cliente_subido.php");
            }
        ?>

        <section class="title">
            <i class='bx bxs-user-detail'></i>
            <h2>Cliente N°<?php echo $fila[0]?> </h2>
        </section>

        <div id="container_info">
            <div>
                <p>Nombre:</p>
                <p> <?php echo $fila[1]?> </p>
            </div>


            <div>
                <p>Apellido:</p>
                <p> <?php echo $fila[2]?> </p>
            </div>

            <hr>

            <div>
                <p>Razón Social:</p>
                <p> 
                    <?php 
                        if (empty($fila[3])) {
                            echo "-";
                        }else{
                            echo $fila[3];
                        }
                    ?>
                </p>
            </div>

            <hr>

            <div>
                <p>Cuil / Cuit:</p>
                <p> 
                    <?php 
                        if (empty($fila[4])) {
                            echo "-";
                        }else{
                            echo $fila[4];
                        }
                    ?>
                </p>
            </div>

            <hr>

            <div>
                <p>Celular:</p>
                <p> <?php echo $fila[5]?> </p>
            </div>

            <hr>

            <div>
                <p>Otro celular:</p>
                <p>
                    <?php 
                        if (is_string($fila[6])) {
                            echo "-";
                        }else{
                            $fila[6];
                        }
                    ?>
                </p>

            </div>

            <hr>

            <div>
                <p>Email:</p>
                <p> <?php echo $fila[7];?> </p>
            </div>

            <hr>

            <div>
                <p>Dirección:</p>
                <p> <?php echo $fila[8]?> </p>
            </div>

            <hr>

            <div>
                <p>Localidad:</p>
                <p> <?php echo $fila[9]?> </p>
            </div>
        </div>

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
        ?>



    
    </main>
    
    
    <script src="../../js/main.js"></script>
</body>
</html>