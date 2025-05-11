<?php
    include('../bd/conexion.php');
    // Inicia la sesión
    session_start();

    // Verifica si el usuario está logueado.
    if (!isset($_SESSION['usuario'])) {
        // Si no está logueado, redirige a la página de inicio de sesión.
        header("Location: login.php");
        // exit();
    }else {

      // CONVIRTIENDO TODO EL USUARIO A MAYUSCULA Y DESPUES A CAPITALICE
      $convertirUsuario = ucwords(strtolower($_SESSION['usuario']));
      
      //sino, calculamos el tiempo transcurrido
      $fechaGuardada = $_SESSION["ultimoAcceso"];

      $ahora = date("Y-n-j H:i:s");
      $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
  
      //comparamos el tiempo transcurrido
       if($tiempo_transcurrido >= 150) {
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
  <?php
        include("../layout/meta.php");
  ?>

  <!-- TITTLE -->
  <title>Dashbord || L-Red</title>
  <!-- STYLES -->
  <link rel="stylesheet" href="../css/dashbord.css">

  <!-- BOXICONS  -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  
  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/439ee37b3b.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php
    include("../layout/nav.php")
  ?>

  <main>
    <section class="title">
      <i class='bx bxs-dashboard'></i>
      <h2>Dashbord</h2>
    </section>

    <div>
      <section>
        <a href="http://lucasconde.ddns.net/L-Red/links/buscar/buscar_cliente.php">
          <h2>
            Clientes
            <i class='bx bxs-user-detail'></i>
          </h2>
          <?php
            if($conexion) {
                $consultation = "SELECT COUNT(*) AS cantidad FROM clientes";
                $resultado = mysqli_query($conexion,$consultation);
        
                if($resultado){
                    while($row = $resultado->fetch_array()){
                        $cantidad  = $row['cantidad'];
        
                        ?>
                          <span id="count1">0</span>
                          
                          <script>
                              document.addEventListener("DOMContentLoaded", () => {
                                function counter(id, start, end, duration) {
                                  let obj = document.getElementById(id),
                                  current = start,
                                  range = end - start,
                                  increment = end > start ? 1 : -1,
                                  step = Math.abs(Math.floor(duration / range)),
                                  timer = setInterval(() => {
                                    current += increment;
                                    obj.textContent = current;
                                    if (current == end) {
                                    clearInterval(timer);
                                    }
                                  }, step);
                                }
                                counter("count1", 0, <?php echo $cantidad ?>, 500);
                                });
                          </script>
                        <?php
                    }
                }
            }
          ?>
        </a>
      </section>

      <section>
        <a href="http://lucasconde.ddns.net/L-Red/links/buscar/buscar_cctv.php">
          <h2>
            Cámaras CCTV
            <i class='bx bxs-cctv'></i>
          </h2>
          <?php
            if($conexion) {
                $consultation = "SELECT COUNT(*) as cantidad FROM trabajos_cctv";
                $resultado = mysqli_query($conexion,$consultation);
        
                if($resultado){
                    while($row = $resultado->fetch_array()){
                        $cantidad  = $row['cantidad'];
        
                        ?>
                          <span id="count2">0</span>
                          
                          <script>
                              document.addEventListener("DOMContentLoaded", () => {
                                function counter(id, start, end, duration) {
                                  let obj = document.getElementById(id),
                                  current = start,
                                  range = end - start,
                                  increment = end > start ? 1 : -1,
                                  step = Math.abs(Math.floor(duration / range)),
                                  timer = setInterval(() => {
                                    current += increment;
                                    obj.textContent = current;
                                    if (current == end) {
                                    clearInterval(timer);
                                    }
                                  }, step);
                                }
                                counter("count2", 0, <?php echo $cantidad ?>, 500);
                                });
                          </script>
                        <?php
                    }
                }
            }
          ?>
        </a>
      </section>

      <section>
        <a href="http://lucasconde.ddns.net/L-Red/links/buscar/buscar_ip.php">
          <h2>
            Cámaras IP
            <i class='bx bxs-camera-home'></i>
          </h2>
          <?php
            if($conexion) {
                $consultation = "SELECT COUNT(*) as cantidad FROM trabajos_ip";
                $resultado = mysqli_query($conexion,$consultation);
        
                if($resultado){
                    while($row = $resultado->fetch_array()){
                        $cantidad  = $row['cantidad'];
        
                        ?>
                          <span id="count3">0</span>
                          
                          <script>
                              document.addEventListener("DOMContentLoaded", () => {
                                function counter(id, start, end, duration) {
                                  let obj = document.getElementById(id),
                                  current = start,
                                  range = end - start,
                                  increment = end > start ? 1 : -1,
                                step = Math.abs(Math.floor(duration / range)),
                                timer = setInterval(() => {
                                  current += increment;
                                  obj.textContent = current;
                                  if (current == end) {
                                  clearInterval(timer);
                                  }
                                  }, step);
                                  }
                                counter("count3", 0, <?php echo $cantidad ?>, 500);
                                });
                          </script>
                        <?php
                    }
                }
            }
          ?>
        </a>
      </section>

      <section>
        <a href="http://lucasconde.ddns.net/L-Red/links/buscar/buscar_red.php">
          <h2>
            Trabajos de Red
            <i class='bx bxs-network-chart'></i>
          </h2>
          <?php
            if($conexion) {
                $consultation = "SELECT COUNT(*) as cantidad FROM trabajos_red";
                $resultado = mysqli_query($conexion,$consultation);
        
                if($resultado){
                    while($row = $resultado->fetch_array()){
                        $cantidad  = $row['cantidad'];
        
                        ?>
                          <span id="count4">0</span>
                          
                          <script>
                              document.addEventListener("DOMContentLoaded", () => {
                                function counter(id, start, end, duration) {
                                  let obj = document.getElementById(id),
                                  current = start,
                                  range = end - start,
                                  increment = end > start ? 1 : -1,
                                  step = Math.abs(Math.floor(duration / range)),
                                  timer = setInterval(() => {
                                    current += increment;
                                    obj.textContent = current;
                                    if (current == end) {
                                    clearInterval(timer);
                                    }
                                  }, step);
                                }
                                counter("count4", 0, <?php echo $cantidad ?>, 500);
                                });
                          </script>
                        <?php
                    }
                }
            }
          ?>
        </a>
      </section>

      <section>
        <h2>
          Total de trabajos
          <i class='bx bx-line-chart'></i>
        </h2>
        <?php
          if($conexion) {
              $consultation = "SELECT SUM(count) AS cantidad
                                FROM (SELECT  COUNT(*) as count
                                    FROM trabajos_cctv UNION ALL
                                  SELECT COUNT(*) as count 
                                    FROM trabajos_ip UNION ALL
                                  SELECT COUNT(*) AS count
                                    FROM trabajos_red
                                ) AS total";
              $resultado = mysqli_query($conexion,$consultation);
      
              if($resultado){
                  while($row = $resultado->fetch_array()){
                      $cantidad  = $row['cantidad'];
      
                      ?>
                        <span id="count5">0</span>
                        
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                              function counter(id, start, end, duration) {
                                let obj = document.getElementById(id),
                                current = start,
                                range = end - start,
                                increment = end > start ? 1 : -1,
                                step = Math.abs(Math.floor(duration / range)),
                                timer = setInterval(() => {
                                  current += increment;
                                  obj.textContent = current;
                                  if (current == end) {
                                  clearInterval(timer);
                                  }
                                }, step);
                              }
                              counter("count5", 0, <?php echo $cantidad ?>, 500);
                              });
                        </script>
                      <?php
                  }
              }
          }
        ?>
      </section>
    </div>
  </main>

  <script src="../js/main.js"></script>
</body>
</html>
