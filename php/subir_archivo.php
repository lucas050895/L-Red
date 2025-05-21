<?php
    include("../bd/conexion.php");

    $clientes_id = intval($_POST['clientes_id']);

    // Consulta para obtener la fecha de trabajo
    $sql = "SELECT fecha_trabajo FROM trabajos_cctv WHERE clientes_id = '$clientes_id' 
            UNION 
            SELECT fecha_trabajo FROM trabajos_red WHERE clientes_id = '$clientes_id'
            UNION 
            SELECT fecha_trabajo FROM trabajos_ip WHERE clientes_id = '$clientes_id'
            LIMIT 1";


    $result = mysqli_query($conexion, $sql);
    
    $row = mysqli_fetch_assoc($result);

    $fecha_trabajo = $row['fecha_trabajo'] ?? date("d-m-Y"); // Usa la fecha de BD 



    // Verificando si existe el directorio y creándolo si es necesario
    $dirLocal = "../files/$clientes_id/$fecha_trabajo/";
    $dirImg = "$dirLocal/img/";
    $dirPdf = "$dirLocal/pdf/";
    $dirExcel = "$dirLocal/excel/";

    if (!file_exists($dirLocal)) {
        mkdir($dirLocal, 0777, true);
    }

    if (!file_exists($dirImg)) {
        mkdir($dirImg, 0777, true);
    }

    if (!file_exists($dirPdf)) {
        mkdir($dirPdf, 0777, true);
    }

    if (!file_exists($dirExcel)) {
        mkdir($dirExcel, 0777, true);
    }

    // Apertura del directorio
    $miDir = opendir($dirLocal); 


    if (isset($_POST['submit']) && !empty($_FILES['foto_after']['name']) > 0) {

            foreach ($_FILES['foto_after']['name'] as $i => $name) {

                if (!empty($_FILES['foto_after']['name'][$i])) {
                
                    $fileName      = $_FILES['foto_after']['name'][$i];
                    $sourceFoto    = $_FILES['foto_after']['tmp_name'][$i];
                    $tamanoFoto    = $_FILES["foto_after"]['size'][$i];
                    $restricciontamano = 500 * 1024 * 1024; // 500 MB en bytes

                    // Verificar tamaño permitido
                    if ($tamanoFoto <= $restricciontamano) {

                        // Renombrar archivo
                        $nuevoNombreFile = substr(md5(uniqid(rand())), 0, 15);
                        $extension_foto  = pathinfo($fileName, PATHINFO_EXTENSION);
                        $nombreFoto      = "{$nuevoNombreFile}_{$clientes_id}.{$extension_foto}";
                        $resultadoFotos  = "$dirImg/$nombreFoto";

                        // Mover archivo a ubicación final
                        if (move_uploaded_file($sourceFoto, $resultadoFotos)) {

                            // Insertar en la base de datos
                            $sql = "INSERT INTO archivos_fotos(clientes_id, nombre) 
                                    VALUES ('$clientes_id', '$nombreFoto')";
                            mysqli_query($conexion, $sql);
                            
                        } else {
                            echo "Error al mover el archivo $fileName";
                        }
                    } else {
                        echo "El archivo $fileName excede el tamaño permitido.";
                    }
                }
            }


            foreach ($_FILES['pdf']['name'] as $i => $name) {

                //strlen método de php pues devuelve la longitud de una cadena
                if (strlen($_FILES['pdf']['name'][$i]) > 1) {
                
                $fileName          = $_FILES['pdf']['name'][$i];
                $sourceFoto        = $_FILES['pdf']['tmp_name'][$i];
                $tamanoFoto        = $_FILES["pdf"]['size'][$i];
                $restricciontamano = "500";//MB

                    if((($tamanoFoto/1024)/1024)<=$restricciontamano){

                        /**Renombrando cada foto que llega desde el formulario */
                        $nuevoNombreFile    = substr(md5(uniqid(rand())),0,15);
                        $extension_foto     = pathinfo($fileName, PATHINFO_EXTENSION);
                        $nombreFoto         = $nuevoNombreFile.'_'.$clientes_id.'.pdf';
                        $resultadoFotos     = $dirPdf.'/'.$nombreFoto;

                        // Mover archivo a una ubicación permanente
                        move_uploaded_file($sourceFoto, $resultadoFotos);
                    
                        // Insertar información del archivo en la base de datos
                        $sql = "INSERT INTO archivos_pdf (clientes_id, nombre)
                                        VALUES ('{$clientes_id}', '{$nuevoNombreFile}_{$clientes_id}.pdf')";
                        mysqli_query($conexion, $sql);
                        
                    }
                }
            }


            foreach ($_FILES['excel']['name'] as $i => $name) {

                //strlen método de php pues devuelve la longitud de una cadena
                if (strlen($_FILES['excel']['name'][$i]) > 1) {
                
                $fileName          = $_FILES['excel']['name'][$i];
                $sourceFoto        = $_FILES['excel']['tmp_name'][$i];
                $tamanoFoto        = $_FILES["excel"]['size'][$i];
                $restricciontamano = "500";//MB

                    if((($tamanoFoto/1024)/1024)<=$restricciontamano){

                        /**Renombrando cada foto que llega desde el formulario */
                        $nuevoNombreFile    = substr(md5(uniqid(rand())),0,15);
                        $extension_foto     = pathinfo($fileName, PATHINFO_EXTENSION);
                        $nombreFoto         = $nuevoNombreFile.'_'.$clientes_id.'.xlsx';
                        $resultadoFotos     = $dirExcel.'/'.$nombreFoto;

                        // Mover archivo a una ubicación permanente
                        move_uploaded_file($sourceFoto, $resultadoFotos);
                    
                        // Insertar información del archivo en la base de datos
                        $sql = "INSERT INTO archivos_excel (clientes_id, nombre)
                                        VALUES ('{$clientes_id}', '{$nuevoNombreFile}.{$clientes_id}.xlsx')";
                        mysqli_query($conexion, $sql);
                        
                    }
                }
            }
        
        header("Location: ../links/subir/archivo_subido.php");
    }else{
        header("Location: ../links/subir/error_archivo_subido.php");
    }

?>