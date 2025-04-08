<?php
    include('../../bd/conecxion.php');
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
    <title>Agregar Trabajo IP || L-Red</title>
    <!-- STYLES -->
    <link rel="stylesheet" href="../../css/general.css">
    <!-- BOXICONS  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <?php
        include("../../layout/nav.php");
    ?>


    <main>
        <section class="title">
            <i class='bx bxs-user-detail'></i>
            <h2>Agregar Trabajo IP</h2>
        </section>

        <form action="../../php/subir_trabajo_ip.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>CLIENTE</legend>
                <div>
                    <label for="id_clientes">Cliente <span>(*)</span></label>
                    <select name="id_clientes" id="id_clientes" required>
                        <option value="" selected disabled>Seleccionar Opción</option>
                        <?php
                            if($conexion) {
                                $consultation = "SELECT *
                                                    FROM clientes
                                                    ORDER BY nombre";
                                $resultado = mysqli_query($conexion,$consultation);
                        
                                if($resultado){
                                    while($row = $resultado->fetch_array()){
                                        $id       = $row['id'];
                                        $nombre   = $row['nombre'];
                                        $apellido = $row['apellido'];
                        
                                        ?>
                                            <option value="<?php echo $id ?>">
                                                <?php echo $nombre . " " . $apellido?>
                                            </option>
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <legend>Cámara</legend>
                    <div>
                        <label for="camara_modelo">Modelo <span>(*)</span></label>
                        <input type="text" name="camara_modelo" id="camara_modelo" required>
                    </div>
            </fieldset>

            <fieldset>
                <legend>IP</legend>
                    <div>
                        <label for="ip_01">IP N° 1 <span>(*)</span></label>
                        <input type="text" name="ip_01" id="ip_01" required>
                    </div>
                    <div>
                        <label for="ip_02">IP N° 2</label>
                        <input type="text" name="ip_02" id="ip_02">
                    </div>
                    <div>
                        <label for="ip_03">IP N° 3 </label>
                        <input type="text" name="ip_03" id="ip_03">
                    </div>
                    <div>
                        <label for="ip_04">IP N° 4 </label>
                        <input type="text" name="ip_04" id="ip_04">
                    </div>
                    <div>
                        <label for="ip_05">IP N° 5 </label>
                        <input type="text" name="ip_05" id="ip_05">
                    </div>
            </fieldset>

            <fieldset>
                <legend>Puertos</legend>
                    <div>
                        <label for="puerto_01">Puerto N° 1 <span>(*)</span></label>
                        <input type="number" name="puerto_01" id="puerto_01" min=0 required>
                    </div>
                    <div>
                        <label for="puerto_02">Puerto N° 2</label>
                        <input type="number" name="puerto_02" id="puerto_02" min=0>
                    </div>
                    <div>
                        <label for="puerto_03">Puerto N° 3</label>
                        <input type="number" name="puerto_03" id="puerto_03" min=0>
                    </div>
                    <div>
                        <label for="puerto_04">Puerto N° 4</label>
                        <input type="number" name="puerto_04" id="puerto_04" min=0>
                    </div>
                    <div>
                        <label for="puerto_05">Puerto N° 5</label>
                        <input type="number" name="puerto_05" id="puerto_05" min=0>
                    </div>

                    
            </fieldset>

            <fieldset>
                <legend>FICHAS</legend>
                    <div>
                        <label for="fichas_rj45">Fichas RJ45 <span>(*)</span></label>
                        <input type="number" name="fichas_rj45" id="fichas_rj45" min=0 required>
                    </div>
                    <div>
                        <label for="fichas_plug">Fichas Plug<span>(*)</span></label>
                        <input type="number" name="fichas_plug" id="fichas_plug" min=0 required>
                    </div>
            </fieldset>

            <fieldset>
                <legend>CABLES</legend>
                    <div>
                        <label for="cables_fuentes">Fuentes <span>(*)</span></label>
                        <input type="number" name="cables_fuentes" id="cables_fuentes" min=0 required>
                    </div>
                    <div>
                        <label for="cables_utp">Metros UTP <span>(*)</span></label>
                        <input type="number" name="cables_utp" id="cables_utp" min=0 required>
                    </div>
                    <div>
                        <label for="cables_zapatilla">Zapatilla <span>(*)</span></label>
                        <select name="cables_zapatilla" id="cables_zapatilla" required>
                            <option value="" selected disabled>Seleccionar Opción</option>
                            <option value="Ninguna">Ninguna</option>
                            <option value="4 Tomas">4 Tomas</option>
                            <option value="5 Tomas">5 Tomas</option>
                        </select>
                    </div>
            </fieldset>

            <fieldset>
                <legend>INSUMOS</legend>
                    <div>
                        <label for="insumos_tar6">Tarugos 6mm</label>
                        <input type="number" name="insumos_tar6" id="insumos_tar6" min=0>
                    </div>
                    <div>
                        <label for="insumos_tor6">Tornillos 6mm</label>
                        <input type="number" name="insumos_tor6" id="insumos_tor6" min=0>
                    </div>
                    <div>
                        <label for="insumos_tar8">Tarugos 8mm</label>
                        <input type="number" name="insumos_tar8" id="insumos_tar8" min=0>
                    </div>
                    <div>
                        <label for="insumos_tor8">Tornillos 8mm</label>
                        <input type="number" name="insumos_tor8" id="insumos_tor8" min=0>
                    </div>
                    <div>
                        <label for="insumos_gra8">Grampas 8mm</label>
                        <input type="number" name="insumos_gra8" id="insumos_gra8" min=0>
                    </div>
                    <div>
                        <label for="insumos_prec">Precintos</label>
                        <input type="number" name="insumos_prec" id="insumos_prec" min=0>
                    </div>
            </fieldset>

            <fieldset>
                <legend>ACCESO</legend>
                    <div>
                        <label for="acceso_usuario">Usuario</label>
                        <input type="text" name="acceso_usuario" id="acceso_usuario" >
                    </div>
                    <div>
                        <label for="acceso_contraseña">Contraseña</label>
                        <input type="text" name="acceso_contraseña" id="acceso_contraseña">
                    </div>
                    <div>
                        <label for="acceso_host">Hots <span>(*)</span></label>
                        <input type="text" name="acceso_host" id="acceso_host" required>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Observaciones</legend>
                <div>
                    <textarea id="observaciones" name="observaciones"></textarea>
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
