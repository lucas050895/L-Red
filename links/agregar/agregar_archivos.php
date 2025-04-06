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
            <i class='bx bxs-cloud-upload'></i>
            <h2>Subir Arhivos</h2>
        </section>
        
        <form action="../../php/subir_archivo.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>CLIENTE</legend>
                <div>
                    <label for="clientes_id">Cliente <span>(*)</span></label>
                    <select name="clientes_id" id="clientes_id" required>
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
                <legend>Archivos</legend>
                    <div>
                        <label for="pdf">Documentos PDF</label>
                        <input type="file" id="pdf" name="pdf[]" multiple accept=".pdf">
                    </div>
                    <div>
                        <label for="excel">Documentos Excel</label>
                        <input type="file" id="excel" name="excel[]" multiple accept=".xlsx">
                    </div>
                    <div>
                        <label for="foto_after">Trabajo Finalizado</label>
                        <input type="file" id="foto_after" name="foto_after[]" multiple accept="image/*">
                    </div>
            </fieldset>

            <div class="container_button">
                <input type="submit" name="submit" value="CARGAR">
            </div>  
        </form>
    </main>


    <script src="../../js/main.js"></script>
</body>
</html>
