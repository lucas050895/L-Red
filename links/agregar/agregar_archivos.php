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

    // Obtener clientes
    $resultado = mysqli_query($conexion, "SELECT id, nombre, apellido, razon
                                                FROM clientes");
                                                
    $clientes = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
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
    <main>
        <section class="title">
            <i class='bx bxs-cloud-upload'></i>
            <h2>Subir Arhivos</h2>
        </section>

        <form action="../../php/subir_archivo.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Cliente</legend>
                <div>
                    <label for="cliente">Nombre o Razón Social:</label>
                    <select name="clientes_id" id="cliente" required>
                        <option value="" selected disabled>Seleccionar Opción</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= $cliente['id']; ?>">
                                <?php
                                    if (is_string($cliente['razon'])){
                                        echo $cliente['razon'];
                                    }else{
                                        echo $cliente['nombre'] . " " . $cliente['apellido'];
                                    }
                                ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <legend>Trabajo</legend>
                <div>
                    <label for="tipo_trabajo">Tipo de Trabajo:</label>
                    <select name="tipo_trabajo" id="tipo_trabajo" required>
                        <option value="" selected disabled>Seleccionar Opción</option>
                        <option value="cctv">CCTV</option>
                        <option value="red">Red</option>
                        <option value="ip">IP</option>
                    </select>
                </div>

                <div>
                    <label for="fecha_trabajo">Fecha de Trabajo:</label>
                    <select name="fecha_trabajo" id="fecha_trabajo" required>
                        <!-- Se llenará dinámicamente con JavaScript -->
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <legend>Archivos</legend>
                <div>
                    <label for="foto">Subir Foto:</label>
                    <input type="file" name="foto_after[]" id="foto" accept="image/*" multiple>
                </div>
                
                <div>
                    <label for="excel">Subir Excel:</label>
                    <input type="file" id="excel" name="excel[]" multiple accept=".xlsx">
                </div>

                <div>
                    <label for="pdf">Subir PDF:</label>
                    <input type="file" id="pdf" name="pdf[]" multiple accept=".pdf">
                </div>
            </fieldset>

            <div class="container_button">
                <input type="submit" name="submit" value="CARGAR">
            </div>  
        </form>
    </main>

    <script>
        document.getElementById('tipo_trabajo').addEventListener('change', function() {
            var tipo = this.value;
            var cliente_id = document.getElementById('cliente').value;
            var trabajosSelect = document.getElementById('fecha_trabajo');
            trabajosSelect.innerHTML = ''; // Limpiar opciones

            if (cliente_id) {
                fetch('obtener_trabajos.php?tipo=' + tipo + '&cliente_id=' + cliente_id)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(trabajo => {
                            var fecha = new Date(trabajo.fecha_trabajo + "T00:00:00"); // Forzar hora fija para evitar cambios por zona horaria
                            var fechaFormateada = fecha.toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' });

                            var option = document.createElement('option');
                            option.value = trabajo.id;
                            option.textContent = fechaFormateada; // Mostrar la fecha correctamente
                            trabajosSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>

    <script src="../../js/main.js"></script>

</body>
</html>