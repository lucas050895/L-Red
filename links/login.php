<?php
    include("../bd/conexion.php");
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
        <form action="../php/check.php" method="post">
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