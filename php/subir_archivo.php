<?php
    include('../bd/conecxion.php');

    $clientes_id  =   $_POST['clientes_id']; 

    //Verificando si existe el directorio
    $dirLocal = "../files/$clientes_id";
    $dirImg = "../files/$clientes_id/img/";
    $dirPdf = "../files/$clientes_id/pdf/";
    $dirExcel = "../files/$clientes_id/excel/";

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

    $miDir         = opendir($dirLocal); //Habro el directorio

    if(isset($_POST['submit']) &&   count($_FILES['foto_after']['name'])>0 || 
                                    count($_FILES['pdf']['name'])>0 ||
                                    count($_FILES['excel']['name'])>0){

        // Recorrer cada archivo subido
        foreach ($_FILES['foto_after']['name'] as $i => $name) {

            //strlen método de php pues devuelve la longitud de una cadena
            if (strlen($_FILES['foto_after']['name'][$i]) > 1) {
            
            $fileName          = $_FILES['foto_after']['name'][$i];
            $sourceFoto        = $_FILES['foto_after']['tmp_name'][$i];
            $tamanoFoto        = $_FILES["foto_after"]['size'][$i];
            $restricciontamano = "500";//MB

                if((($tamanoFoto/1024)/1024)<=$restricciontamano){

                /**Renombrando cada foto que llega desde el formulario */
                $nuevoNombreFile    = substr(md5(uniqid(rand())),0,15);
                $extension_foto     = pathinfo($fileName, PATHINFO_EXTENSION);
                $nombreFoto         = $nuevoNombreFile.'_'.$clientes_id.'.jpg';
                $resultadoFotos     = $dirImg.'/'.$nombreFoto;

                    // Mover archivo a una ubicación permanente
                    move_uploaded_file($sourceFoto, $resultadoFotos);
                
                    // Insertar información del archivo en la base de datos
                    $sql = "INSERT INTO archivos_fotos (clientes_id, nombre, ruta)
                                    VALUES ('{$clientes_id}', '{$nuevoNombreFile}.{$clientes_id}.jpg', '{$dirImg}')";
                    mysqli_query($conexion, $sql);
                    
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
                    $sql = "INSERT INTO archivos_pdf (clientes_id, nombre, ruta)
                                    VALUES ('{$clientes_id}', '{$nuevoNombreFile}_{$clientes_id}.pdf', '{$dirPdf}')";
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
                    $sql = "INSERT INTO archivos_excel (clientes_id, nombre, ruta)
                                    VALUES ('{$clientes_id}', '{$nuevoNombreFile}.{$clientes_id}.xlsx', '{$dirExcel}')";
                    mysqli_query($conexion, $sql);
                    
                }
            }
        }



        header("Location: ../links/subir/archivo_subido.php");

    }
?>