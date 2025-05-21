<?php
    include("../../bd/conexion.php");

    $cliente_id = $_GET['cliente_id'];
    $tipo = $_GET['tipo'];

    $tabla = "";
    if ($tipo == "cctv") {
        $tabla = "trabajos_cctv";
    } elseif ($tipo == "red") {
        $tabla = "trabajos_red";
    } elseif ($tipo == "ip") {
        $tabla = "trabajos_ip";
    }

    // **Corrección en la consulta: incluir fecha_trabajo**
    $resultado = mysqli_query($conexion, "SELECT id, fecha_trabajo
                                            FROM $tabla
                                            WHERE clientes_id = $cliente_id
                                            GROUP BY fecha_trabajo");

    // Verificar si hay resultados
    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    echo json_encode(mysqli_fetch_all($resultado, MYSQLI_ASSOC));
?>