<?php
    include("../../bd/conexion.php");

    // Inicia la sesión
    session_start();

    // Verifica si el usuario está logueado.
    if (!isset($_SESSION['usuario'])) {
        // Si no está logueado, redirige a la página de inicio de sesión.
        header("Location: ../login.php");
        exit();
    }
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
    <title>Agregar Cliente || L-Red</title>
    <!-- STYLES -->
    <link rel="stylesheet" href="../../css/general.css">
    <!-- BOXICONS  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
