<div class="wrapper">
  <input type="checkbox" id="btn" hidden>

  <label for="btn" class="menu-btn">
    <i class='bx bx-menu-alt-left'></i>
    <i class='bx bx-x'></i>
  </label>

    <nav id="sidebar">
      <h1 class="title">L-Red</h1>

      <ul class="list-items">
        <li>
          <a href="http://lucasconde.ddns.net/index.php">
            <i class='bx bxs-dashboard'></i>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="accordion">
          <div class="accordion-heading">
            <i class='bx bxs-plus-circle'></i>
            <span>Agregar</span>
          </div>

          <div class="accordion-body">
            <a href="http://lucasconde.ddns.net/links/agregar/agregar_cliente.php">
              <i class='bx bxs-user-detail'></i>
              <span>Cliente</span>
            </a>

            <a href="http://lucasconde.ddns.net/links/agregar/agregar_cctv.php">
              <i class='bx bxs-cctv'></i>
              <span>Cámaras CCTV</span>
            </a>

            <a href="http://lucasconde.ddns.net/links/agregar/agregar_ip.php">
              <i class='bx bxs-camera-home'></i>
              <span>Cámaras IP</span>
            </a>

            <a href="http://lucasconde.ddns.net/links/agregar/agregar_red.php">
              <i class='bx bxs-network-chart'></i>
              <span>Trabajos de Red</span>
            </a>

            <a href="http://lucasconde.ddns.net/links/agregar/agregar_archivos.php">
              <i class='bx bxs-cloud-upload'></i>
              <span>Subir Archivos</span>
            </a>
          </div>
        </li>

        <li class="accordion">
          <div class="accordion-heading">
            <i class='bx bx-search-alt-2'></i>
            <span>Buscar</span>
          </div>

          <div class="accordion-body">
            <a href="http://lucasconde.ddns.net/links/buscar/buscar_cliente.php">
              <i class='bx bxs-contact'></i>
              <span>Cliente</span>
            </a>

            <a href="http://lucasconde.ddns.net/links/buscar/buscar_cctv.php">
              <i class='bx bxs-cctv'></i>
              <span>Cámaras CCTV</span>
            </a>

            <a href="http://lucasconde.ddns.net/links/buscar/buscar_ip.php">
              <i class='bx bxs-camera-home'></i>
              <span>Cámaras IP</span>
            </a>

            <a href="http://lucasconde.ddns.net/links/buscar/buscar_red.php">
              <i class='bx bxs-network-chart'></i>
              <span>Trabajos de Red</span>
          </div>
        </li>

        <li>
          <a href="http://lucasconde.ddns.net/links/presupuestador.php">
            <i class='bx bxs-dollar-circle'></i>
            <span>Presupuestador</span>
          </a>
        </li>

      </ul>
    </nav>
</div>


<script>
  /*ACORDEON*/
  const accordions = document.getElementsByClassName('accordion-heading');

  for ( const acc of accordions ) {
    acc.addEventListener('click', function() {
      const body = this.nextElementSibling;
      body.classList.toggle('open');
      const indication = this.querySelector('.state-indication');
      if ( indication.classList.contains('plus') ) {
        indication.classList.remove('plus');
        indication.classList.add('minus');
      } else if ( indication.classList.contains('minus') ) {
        indication.classList.remove('minus');
        indication.classList.add('plus');
      }
    } );
  }
</script>