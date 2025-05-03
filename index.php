<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio Técnico</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/index.css">
    <!-- FONT AWESOME -->   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

    <div id="home">
        <i class="fas fa-users-cog"></i>
        <h1>
            SERVICIO TÉCNICO
        </h1>
        <a href="#jobs">
            <i class="fas fa-chevron-down"></i>
        </a>
    </div>

    <div id="jobs">
        <h2 class="title">Trabajos</h2>
        <div class="container">
            <div class="card">
                <img src="#">
                <div>
                    <div class="name">
                        Trabajo
                    </div>
                    <div class="text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                    </div>
                    
                    <a href="#">Ver</a>
                </div>
            </div>

            <div class="card">
                <img src="#">
                <div>
                    <div class="name">
                        Trabajo
                    </div>
                    <div class="text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                    </div>

                    <a href="#">Ver</a>
                </div>
            </div>

            <div class="card">
                <img src="#">
                <div>
                    <div class="name">
                        Trabajo
                    </div>
                    <div class="text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                    </div>
                    
                    <a href="#">Ver</a>
                </div>
            </div>

            <div class="card">
                <img src="#">
                <div>
                    <div class="name">
                        Trabajo
                    </div>
                    <div class="text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                    </div>
                    
                    <a href="#">Ver</a>
                </div>
            </div>

        </div>
    </div>

    <div id="contact">
        <h2 class="title">Contacto</h2>
            <div class="wrapper">
                <form action="php/enviar_correo.php" method="POST">
                    <h3>Consulta</h3>
                    <div class="field">
                        <input type="text" required id="nombre" name="nombre">
                        <label for="nombre">Nombre completo (*)</label>
                    </div>
                    <div class="field">
                        <input type="text" required id="correo" name="correo">
                        <label for="correo">Email (*)</label>
                    </div>
                    <div class="field">
                        <input type="tel" required id="celular" name="celular">
                        <label for="celular">Celular (*)</label>
                    </div>
                    <div class="field">
                        <input type="text" required id="mensaje" name="mensaje">
                        <label for="mensaje">Mensaje (*)</label>
                    </div>
                    <button type="submit">Enviar</button>
                    <span> (*) Campos obligatorios</span>
                </form>
            </div>
    </div>

    <div id="redes">
        <h3>Seguinos en: </h3>
        <div>
            <a href="http://facebook.com" target="_blank">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="https://wa.me/5491176145568" target="_blank">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
        </div>
    </div>

    <?php
        include("layout/footer.php");
    ?>

</body>
</html>