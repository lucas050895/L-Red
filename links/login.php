<?php
    include("../bd/conexion.php");

    if(isset($_POST['entrar'])){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        $sql = "SELECT *
                    FROM usuarios
                    WHERE usuario = '$usuario' AND password = '$password'";

        $resultado = mysqli_query($conexion, $sql);

        if($resultado->num_rows>0){
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['ultimoAcceso'] = date("Y-n-j H:i:s");
            header("Location: dashbord.php");
            exit();
        }else{
            echo "<script>alert('Usuario o password incorrectos');</script>";
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
                    <input type="text" id="usuario" name="usuario" required placeholder="Usuario">
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Password">
                </div>
            </fieldset>
            <input type="submit" id="entrar" name="entrar" value="Entrar"> 
        </form>
    </main>
    
</body>
</html>