<?php
    include('../bd/conecxion.php');

    $clientes_id  =   $_POST['clientes_id']; 

    //CREO LA DIRECCION DE DONDE SE ALMACENA LOS ARCHIVOS
    $dir = "../files/$clientes_id/";
    $tamaño = 70000;
    $ruta = $dir.$clientes_id.'.pdf';

    if($_FILES["image_finish"]['size'] <($tamaño  * 1024)){
        //SI NO EXITE LA CARPETA (EN ESTE CASO ES EL CLIENTE_ID), LA CREA AUTOMATICAMENTE
        if(!file_exists($dir)){
            mkdir($dir, 0777);
        }

        if(move_uploaded_file($_FILES['image_finish']['tmp_name'], $ruta)){

            if(isset($_POST['submit'])){
                $sql = "INSERT INTO archivos(clientes_id,nombre,ruta)
                                    VALUES ('{$clientes_id}','{$clientes_id}','{$ruta}')";
                mysqli_query($conexion, $sql);
            }
            // Redirigir a la página de exitoso
            header("Location: ../links/archivo_subido.php");
        }else{
            // Redirigir a la página de exitoso
            header("Location: ../links/error_archivo_subido.php");
        }
    }else{
        // Redirigir a la página de exitoso
        header("Location: ../links/error_archivo_subido.php");
    }
?>