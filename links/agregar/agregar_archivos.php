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
    <title>Agregar Cliente || L-Red</title>
    
    <!-- STYLES -->
    <link rel="stylesheet" href="../../css/general.css">

    <?php
        include("../../layout/iconos.php");
    ?>
</head>
<body>
    <?php
        include("../../layout/nav.php")
    ?>

    <main>
        <section class="title">
            <i class='bx bxs-cloud-upload'></i>
            <h2>Subir Arhivos</h2>
        </section>
        
        <form action="../../php/subir_archivo.php" method="POST" enctype="multipart/form-data">
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
                <legend>Archivos</legend>
                    <div>
                        <label for="pdf">Documentos PDF</label>
                        <input type="file" id="pdf" name="pdf[]" multiple accept=".pdf">
                    </div>
                    <div>
                        <label for="excel">Documentos Excel</label>
                        <input type="file" id="excel" name="excel[]" multiple accept=".xlsx">
                    </div>
                    <div>
                        <label for="foto_after">Trabajo Finalizado</label>
                        <input type="file" id="foto_after" name="foto_after[]" multiple accept="image/*">
                    </div>
            </fieldset>

            <div class="container_button">
                <input type="submit" name="submit" value="CARGAR">
            </div>  
        </form>
    </main>


    <script src="../../js/main.js"></script>
</body>
</html>
