<?php
    include('../bd/conecxion.php');

    $clientes_id        =   $_POST['clientes_id'];
    
    $equipo_tipo        =   $_POST['equipo_tipo'];
    $equipo_modelo      =   $_POST['equipo_modelo'];

    $cables_utp         =   $_POST['cables_utp'];
    $cables_par         =   $_POST['cables_par'];

    $fichas_rj45        =   $_POST['fichas_rj45'];
    $fichas_empalme     =   $_POST['fichas_empalme'];

    $rack               =   $_POST['rack'];

    $insumos_tar6       =   $_POST['insumos_tar6'];
    $insumos_tor6       =   $_POST['insumos_tor6'];
    $insumos_tar8       =   $_POST['insumos_tar8'];
    $insumos_tor8       =   $_POST['insumos_tor8'];
    $insumos_gra8       =   $_POST['insumos_gra8'];
    $insumos_prec       =   $_POST['insumos_prec'];

    $observaciones      =   $_POST['observaciones'];

    if(isset($_POST['submit'])){
        $sql = "INSERT INTO trabajos_red(
                                        clientes_id      ,

                                        equipo_tipo      ,
                                        equipo_modelo    ,

                                        cables_utp       ,
                                        cables_par       ,

                                        fichas_rj45      ,
                                        fichas_empalme   ,

                                        rack             ,

                                        insumos_tar6     , 
                                        insumos_tor6     ,
                                        insumos_tar8     , 
                                        insumos_tor8     ,
                                        insumos_gra8     , 
                                        insumos_prec     ,
                                    
                                        observaciones 
                                    )
                            VALUES (
                                        '{$clientes_id}'      ,

                                        '{$equipo_tipo}'      ,
                                        '{$equipo_modelo}'    ,

                                        '{$cables_utp}'       ,
                                        '{$cables_par}'       ,

                                        '{$fichas_rj45}'      ,
                                        '{$fichas_empalme}'   ,

                                        '{$rack}'             ,

                                        '{$insumos_tar6}'     ,
                                        '{$insumos_tor6}'     ,
                                        '{$insumos_tar8}'     ,
                                        '{$insumos_tor8}'     ,
                                        '{$insumos_gra8}'     ,
                                        '{$insumos_prec}'     ,

                                        '{$observaciones}'
                                    )";
        mysqli_query($conexion, $sql);
    }

    // Cerrar conexión a la base de datos
    mysqli_close($conexion);

    // Redirigir a la página de exitoso
    header("Location: ../links/subir/trabajo_subido.php");
?>
