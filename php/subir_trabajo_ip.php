<?php
    include('../bd/conexion.php');

    $clientes_id        =   $_POST['clientes_id'];
    
    $camara_marca       =   $_POST['camara_marca'];
    $camara_modelo      =   $_POST['camara_modelo'];
    $camara_nombre      =   $_POST['camara_nombre'];

    $ip                 =   $_POST['ip'];

    $puertos            =   $_POST['puertos'];

    $fichas_rj45        =   $_POST['fichas_rj45'];
    $fichas_plug        =   $_POST['fichas_plug'];

    $cables_fuentes     =   $_POST['cables_fuentes'];
    $cables_utp         =   $_POST['cables_utp'];
    $cables_zapatilla   =   $_POST['cables_zapatilla'];

    $insumos_tar6       =   $_POST['insumos_tar6'];
    $insumos_tor6       =   $_POST['insumos_tor6'];
    $insumos_tar8       =   $_POST['insumos_tar8'];
    $insumos_tor8       =   $_POST['insumos_tor8'];
    $insumos_gra8       =   $_POST['insumos_gra8'];
    $insumos_prec       =   $_POST['insumos_prec'];

    $acceso_usuario     =   $_POST['acceso_usuario'];
    $acceso_contraseña  =   $_POST['acceso_contraseña'];
    $acceso_host        =   $_POST['acceso_host'];

    $observaciones      =   $_POST['observaciones'];

    if(isset($_POST['submit'])){
        $sql = "INSERT INTO trabajos_ip(
                                        clientes_id      ,

                                        camara_marca     ,
                                        camara_modelo    ,
                                        camara_nombre    ,

                                        fichas_rj45      ,
                                        fichas_plug      ,

                                        cables_fuentes   ,
                                        cables_utp       ,
                                        cables_zapatilla ,

                                        insumos_tar6     , 
                                        insumos_tor6     ,
                                        insumos_tar8     , 
                                        insumos_tor8     ,
                                        insumos_gra8     , 
                                        insumos_prec     ,

                                        acceso_usuario   ,
                                        acceso_contraseña,
                                        acceso_host      ,
                                        
                                        observaciones 
                                    )
                            VALUES (
                                        '{$clientes_id}'      ,

                                        '{$camara_marca}'     ,
                                        '{$camara_modelo}'    ,
                                        '{$camara_nombre}'    ,

                                        '{$fichas_rj45}'      ,
                                        '{$fichas_plug}'      ,

                                        '{$cables_fuentes}'   ,
                                        '{$cables_utp}'       ,
                                        '{$cables_zapatilla}' ,  

                                        '{$insumos_tar6}'     ,
                                        '{$insumos_tor6}'     ,
                                        '{$insumos_tar8}'     ,
                                        '{$insumos_tor8}'     ,
                                        '{$insumos_gra8}'     ,
                                        '{$insumos_prec}'     ,

                                        '{$acceso_usuario}'   ,
                                        '{$acceso_contraseña}',
                                        '{$acceso_host}',

                                        '{$observaciones}'
                                    )";
        mysqli_query($conexion, $sql);
    }

      if(isset($_POST['submit'])){
        $sql = "INSERT INTO trabajos_ip_detalles(
                                        clientes_id      ,
                                        ip               ,
                                        puertos          ,
                                        camara_nombre    
                                    )
                            VALUES (
                                        '{$clientes_id}' ,
                                        '{$ip}'          ,
                                        '{$puertos}'     ,
                                        '{$camara_nombre}'
                                    )";
        mysqli_query($conexion, $sql);
    }

    // Cerrar conexión a la base de datos
    mysqli_close($conexion);

    // Redirigir a la página de exitoso
    header("Location: ../links/subir/trabajo_subido.php");
?>
