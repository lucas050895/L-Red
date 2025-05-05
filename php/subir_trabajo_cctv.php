<?php
    include('../bd/conexion.php');

    $clientes_id        =   $_POST['clientes_id'];
    
    $dvr_marca          =   $_POST['dvr_marca'];
    $dvr_modelo         =   $_POST['dvr_modelo'];
    $dvr_disco          =   $_POST['dvr_disco'];
    $dvr_capacidad      =   $_POST['dvr_capacidad'];
    $dvr_medida         =   $_POST['dvr_medida'];

    $camaras_cantidad   =   $_POST['camaras_cantidad']; 
    $camaras_modelo     =   $_POST['camaras_modelo'];
    $camaras_caja       =   $_POST['camaras_caja'];

    $fichas_balum       =   $_POST['fichas_balum'];
    $fichas_rj45        =   $_POST['fichas_rj45'];

    $cables_utp         =   $_POST['cables_utp'];
    $cables_patch       =   $_POST['cables_patch'];
    $cables_zapatilla   =   $_POST['cables_zapatilla'];
    $cables_fuente      =   $_POST['cables_fuente'];
    $cables_pulpito     =   $_POST['cables_pulpito'];
    $cables_hdmi        =   $_POST['cables_hdmi'];

    $insumos_tar6       =   $_POST['insumos_tar6'];
    $insumos_tor6       =   $_POST['insumos_tor6'];
    $insumos_tar8       =   $_POST['insumos_tar8'];
    $insumos_tor8       =   $_POST['insumos_tor8'];
    $insumos_gra8       =   $_POST['insumos_gra8'];
    $insumos_prec       =   $_POST['insumos_prec'];

    $acceso_usuario     =   $_POST['acceso_usuario'];
    $acceso_contraseña  =   $_POST['acceso_contraseña'];

    $observaciones      =   $_POST['observaciones'];

    if(isset($_POST['submit'])){
        $sql = "INSERT INTO trabajos_cctv(
                                        clientes_id      ,

                                        dvr_marca        ,
                                        dvr_modelo       ,
                                        dvr_disco        , 
                                        dvr_capacidad    ,
                                        dvr_medida       ,

                                        camaras_cantidad ,
                                        camaras_modelo   , 
                                        camaras_caja     ,

                                        fichas_balum     ,
                                        fichas_rj45      ,

                                        cables_utp       ,
                                        cables_patch     ,
                                        cables_zapatilla ,
                                        cables_fuente    ,
                                        cables_pulpito   ,
                                        cables_hdmi      ,

                                        insumos_tar6     , 
                                        insumos_tor6     ,
                                        insumos_tar8     , 
                                        insumos_tor8     ,
                                        insumos_gra8     , 
                                        insumos_prec     ,

                                        acceso_usuario   ,
                                        acceso_contraseña,
                                        
                                        observaciones 
                                    )
                            VALUES (
                                        '{$clientes_id}'      ,

                                        '{$dvr_marca}'        ,
                                        '{$dvr_modelo}'       ,
                                        '{$dvr_disco}'        ,
                                        '{$dvr_capacidad}'    ,
                                        '{$dvr_medida}'       ,

                                        '{$camaras_cantidad}' ,
                                        '{$camaras_modelo}'   ,
                                        '{$camaras_caja}'     ,

                                        '{$fichas_balum}'     ,
                                        '{$fichas_rj45}'      ,

                                        '{$cables_utp}'       ,
                                        '{$cables_patch}'     ,
                                        '{$cables_zapatilla}' ,
                                        '{$cables_fuente}'    ,
                                        '{$cables_pulpito}'   ,
                                        '{$cables_hdmi}'      ,    

                                        '{$insumos_tar6}'     ,
                                        '{$insumos_tor6}'     ,
                                        '{$insumos_tar8}'     ,
                                        '{$insumos_tor8}'     ,
                                        '{$insumos_gra8}'     ,
                                        '{$insumos_prec}'     ,

                                        '{$acceso_usuario}'   ,
                                        '{$acceso_contraseña}',

                                        '{$observaciones}'
                                    )";
        mysqli_query($conexion, $sql);
    }

    // Cerrar conexión a la base de datos
    mysqli_close($conexion);

    // Redirigir a la página de exitoso
    header("Location: ../links/subir/trabajo_subido.php");
?>
