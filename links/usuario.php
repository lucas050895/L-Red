<?php
    include("../bd/conexion.php");

    session_start();


    // Verifica si el usuario está logueado.
    if (!isset($_SESSION['usuario'])) {
        // Si no está logueado, redirige a la página de inicio de sesión.
        header("Location: login.php");
        // exit();
    }else {
        
        $convertirUsuario = ucwords(strtolower($_SESSION['usuario']));

        //sino, calculamos el tiempo transcurrido
        $fechaGuardada = $_SESSION["ultimoAcceso"];

        $user = $_SESSION['usuario'];

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
    <title>Usuario || L-Red</title>

	<!-- ESTILOS -->
    <link rel="stylesheet" href="../css/usuario.css">

    <!-- ICONOS -->
    <?php include('../layout/iconos.php'); ?>
</head>
<body>
    <?php
        include("../layout/nav.php")
    ?>

    <main>     

        <section class="title">
            <i class="fas fa-user"></i>
            <h2>Usuario</h2>
        </section>

        <form action="../php/subir_usuario.php" method="post">
            <fieldset>
                <legend>Información</legend>

                <?php
                    $resultadoUsuario = $conexion->query("SELECT usuarios.*, usuarios_nivel.nombre AS nivel
                                                            FROM usuarios
                                                            INNER JOIN usuarios_nivel ON usuarios.usuarios_nivel = usuarios_nivel.id
                                                            WHERE usuario LIKE '$user' ");

                    while ($fila = $resultadoUsuario->fetch_assoc()) { ?>

                        <section>
                            <h2>Usuario: </h2>
                            <div>
                                <?php echo $fila['usuario'] ?>
                            </div>
                            <i class="fa-solid fa-pen"></i>
                        </section>

                        <section>
                            <h2>Password: </h2>
                            <div>
                                <?php echo $fila['password'] ?>
                            </div>
                            <i class="fa-solid fa-pen"></i>
                        </section>

                        <section>
                            <h2>Nivel: </h2>
                            <div>
                                <?php echo $fila['nivel'] ?>
                            </div>
                            <i class="fa-solid fa-pen"></i>
                        </section>
                   <?php } ?>

            </fieldset>

            <fieldset>
                <legend>Agregar</legend>
                
                <div>
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario">
                </div>

                <div>
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password">
                </div>


                <div>
                    <label for="nivel">Nivel</label>
                    <select name="nivel" id="nivel">
                        <option value="" selected disabled>Seleccionar nivel</option>
                        <?php
                            $resultadoNivel = $conexion->query("SELECT * FROM usuarios_nivel");

                            while ($fila = $resultadoNivel->fetch_assoc()) {
                                echo "<option value='{$fila['id']}'>{$fila['nombre']}</option>";
                            }
                        ?>
                    </select>
                </div>

                <div>
                    <input type="submit" name="submit" value="CARGAR">
                </div>
            </fieldset>
        </form>
    </main>
</body>
</html>