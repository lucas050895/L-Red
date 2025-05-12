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
            <i class='bx bxs-user-detail'></i>
            <h2>Agregar Cliente</h2>
        </section>
        
        <form action="../../php/subir_cliente.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>DATOS</legend>
                    <div>
                        <label for="nombre">Nombre <span>(*)</span></label>
                        <input type="text" name="nombre" id="nombre" required>
                    </div>
                    <div>
                        <label for="apellido">Apellido <span>(*)</span></label>
                        <input type="text" name="apellido" id="apellido" required>
                    </div>

                    <hr>

                    <div>
                        <label for="razon">Razón social</label>
                        <input type="text" name="razon" id="razon">
                    </div>
                    <div>
                        <label for="cuilcuit">Cuit/Cuil</label>
                        <input type="number" name="cuilcuit" id="cuilcuit" min=0>
                    </div>
                    
                    <hr>

                    <div>
                        <label for="celular">Celular <span>(*)</span></label>
                        <input type="number" name="celular" id="celular" min=0 required>
                    </div>
                    <div>
                        <label for="otro">Otro celular</label>
                        <input type="number" name="otro" id="otro" min=0>
                    </div>
                    <div>
                        <label for="email">Email <span>(*)</span></label>
                        <input type="email" name="email" id="email" require>
                    </div>

                    <hr>

                    <div>
                        <label for="direccion">Dirección <span>(*)</span></label>
                        <input type="text" name="direccion" id="direccion" required>
                    </div>
                    <div>
                        <label for="localidad">Localidad <span>(*)</span></label>
                        <input type="text" name="localidad" id="localidad" required>
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
