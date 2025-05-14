<?php
header('Content-Type: text/html; charset=UTF-8');

require('fpdf/fpdf.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function getNumericValue($value) {
        return is_numeric($value) ? (float)$value : 0;
    }

    $pdf = new FPDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(190, 10, 'Presupuesto', 1, 1, 'C');

    $pdf->Ln(10);

    // Encabezados
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(70, 10, 'Producto', 1);
    $pdf->Cell(30, 10, 'Cantidad', 1);
    $pdf->Cell(40, 10, 'Precio', 1);
    $pdf->Cell(50, 10, 'Subtotal', 1);
    $pdf->Ln();

    // Lista de productos con valores pasados desde el formulario
    $items = [
        ['DVR', getNumericValue($_POST['cantidad_dvr']), getNumericValue($_POST['producto_dvr']), getNumericValue($_POST['subtotal_dvr'])],

        ['Cámaras', getNumericValue($_POST['cantidad_camara']), getNumericValue($_POST['producto_camara']), getNumericValue($_POST['subtotal_camara'])],

        ['Cable UTP', getNumericValue($_POST['cantidad_utp']), getNumericValue($_POST['producto_utp']), getNumericValue($_POST['subtotal_utp'])],

        ['Fuentes', getNumericValue($_POST['cantidad_fuentes']), getNumericValue($_POST['producto_fuentes']), getNumericValue($_POST['subtotal_fuentes'])],

        ['Balun', getNumericValue($_POST['cantidad_balun']), getNumericValue($_POST['producto_balun']), getNumericValue($_POST['subtotal_balun'])],

        ['Caja Estanca', getNumericValue($_POST['cantidad_caja']), getNumericValue($_POST['producto_caja']), getNumericValue($_POST['subtotal_caja'])],

        ['Balunera', getNumericValue($_POST['cantidad_balunera']), getNumericValue($_POST['producto_balunera']), getNumericValue($_POST['subtotal_balunera'])],

        ['Insumos', getNumericValue($_POST['cantidad_insumos']), getNumericValue($_POST['producto_insumos']), getNumericValue($_POST['subtotal_insumos'])],

        ['Zapatilla eléctrica', getNumericValue($_POST['cantidad_zapatilla']), getNumericValue($_POST['producto_zapatilla']), getNumericValue($_POST['subtotal_zapatilla'])]
    ];

    foreach ($items as $item) {
        $cantidad = getNumericValue($item[1]);
        $precioUnitario = getNumericValue($item[2]);
        $subtotal = getNumericValue($item[3]);

        // Si el precio unitario es 0, mostrar "-"
        $precioFormateado = ($precioUnitario == 0) ? "-" : "$" . number_format($precioUnitario, 0, ',', '.');

        // Si el subtotal es 0, mostrar "-"
        $subtotalFormateado = ($subtotal == 0) ? "-" : "$" . number_format($subtotal, 0, ',', '.');

        // Si el precio y el subtotal son "-", entonces la cantidad también debe ser "-"
        $cantidadFormateada = ($precioFormateado == "-" && $subtotalFormateado == "-") ? "-" : $cantidad;

        $pdf->Cell(70, 10, utf8_decode($item[0]), 1); // Nombre del producto
        $pdf->Cell(30, 10, $cantidadFormateada, 1); // Cantidad con validación
        $pdf->Cell(40, 10, $precioFormateado, 1); // Precio unitario con validación
        $pdf->Cell(50, 10, $subtotalFormateado, 1); // Subtotal con validación
        $pdf->Ln();
    }

    $totalGeneral = getNumericValue($_POST['total_general']);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(140, 10, 'Total General', 1);
    $pdf->Cell(50, 10, '$' . number_format($totalGeneral, 0, ',', '.'), 1);
    $pdf->Ln();

    $pdf->Output();
} else {
    echo "Error: No se recibieron datos.";
}
?>