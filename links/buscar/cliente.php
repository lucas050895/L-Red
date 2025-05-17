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
        $resultado = $conexion -> query ("SELECT * FROM clientes WHERE id=" . $_GET['id'])or die($conexion -> error);
        if(mysqli_num_rows($resultado) > 0){
            $fila = mysqli_fetch_row($resultado);
        }else{
            header("Location: http://lucasconde.ddns.net/L-Red/links/buscar/buscar_cliente.php");
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
    <title>Cliente || L-Red</title>

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

            <hr>

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
                                        <a href="../<?php echo $fila['ruta'] . $fila['nombre']; ?>" type="application/pdf">Abrir PDF - <?php echo $fila['nombre'] ?></a>
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