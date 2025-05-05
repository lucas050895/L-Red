<?php
    include("../bd/conexion.php");

    if(isset($_POST['entrar'])){
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        $sql = "SELECT *
                    FROM usuarios
                    WHERE usuario = '$usuario' AND contraseña = '$contraseña'";

        $resultado = mysqli_query($conexion, $sql);

        if($resultado->num_rows>0){
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['ultimoAcceso'] = date("Y-n-j H:i:s");
            header("Location: dashbord.php");
            exit();
        }else{
            echo "<script>alert('Usuario o contraseña incorrectos');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        include("../layout/meta.php");
    ?>
    <title>Inciar Sesión || L-Red</title>

    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <main>
        <form action="login.php" method="post">
            <fieldset>
                <legend>login</legend>
                <div>
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" required placeholder="Lucas || Leo">
                </div>

                <div>
                    <label for="contraseña">Contraseña</label>
                    <input type="text" id="contraseña" name="contraseña" required placeholder="1234">
                </div>
            </fieldset>
            <input type="submit" id="entrar" name="entrar" value="Entrar"> 
        </form>
    </main>
    
</body>
</html>