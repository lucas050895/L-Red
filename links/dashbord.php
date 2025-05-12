<?php
    include("../bd/conexion.php");
    // Inicia la sesión
    session_start();

    // Verifica si el usuario está logueado.
    if (!isset($_SESSION['usuario'])) {
        // Si no está logueado, redirige a la página de inicio de sesión.
        header("Location: login.php");
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
        header("Location: login.php"); //envío al usuario a la pag. de autenticación
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
        include("../layout/meta.php");
  ?>

  <!-- TITTLE -->
  <title>Dashbord || L-Red</title>
  <!-- STYLES -->
  <link rel="stylesheet" href="../css/dashbord.css">

  <?php include("../layout/iconos.php")?>
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
                $consultation = "SELECT *
                                    FROM trabajos_ip
                                    group by clientes_id";
                $resultado = mysqli_query($conexion,$consultation);
        
                if($resultado){
                    while($row = $resultado->fetch_array()){
                        $id  = $row['id'];
        
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
                                counter("count3", 0, <?php echo $id ?>, 500);
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
              $consultation = "SELECT COUNT(trabajos_cctv.clientes_id) AS CLIENTE_CCTV,
                                      COUNT(trabajos_ip.clientes_id) AS CLIENTE_IP,
                                      COUNT(trabajos_red.clientes_id) AS CLIENTE_RED,

                                          (SELECT count(clientes_id) FROM trabajos_cctv
                                            WHERE clientes_id) AS CCTV,

                                          (SELECT trabajos_ip.clientes_id
                                          WHERE trabajos_ip.clientes_id = clientes.id) AS IP,
                                          
                                          (SELECT count(clientes_id) FROM trabajos_red
                                            WHERE clientes_id) AS RED
                                              
                                    FROM clientes
                                    LEFT JOIN trabajos_red ON trabajos_red.clientes_id = clientes.id
                                    LEFT JOIN trabajos_cctv ON trabajos_cctv.clientes_id = clientes.id
                                    LEFT JOIN trabajos_ip ON trabajos_ip.clientes_id = clientes.id";
              $resultado = mysqli_query($conexion,$consultation);
      
              if($resultado){
                  while($row = $resultado->fetch_array()){
                      $CCTV  = $row['CCTV'];
                      $IP    = $row['IP'];
                      $RED   = $row['RED'];
      
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
                              counter("count5", 0, <?php echo $CCTV + $IP + $RED ?>, 500);
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
