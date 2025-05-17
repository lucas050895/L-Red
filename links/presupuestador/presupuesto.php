<?php
use Dompdf\Dompdf;
use Dompdf\Options;



require 'dompdf/vendor/autoload.php';

$options = new Options();
$options->set('defaultFont', 'Arial');
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
// $options = new Dompdf\Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // Permite cargar imágenes remotas si es necesario

$dompdf = new Dompdf($options);

date_default_timezone_set('UTC');

$dompdf = new Dompdf($options);


// Capturar los datos del cliente
// Capturar los datos del cliente enviados desde el formulario
$cliente = [
    "id" => $_POST['cliente_id'] ?? 'No definido',
    "nombre" => $_POST['cliente_nombre'] ?? 'No definido',
    "apellido" => $_POST['cliente_apellido'] ?? 'No definido',
    "razon" => $_POST['cliente_razon'] ?? 'No definido'
];



$rutaImagen = '../../assets/img/example.jpg'; // Ajusta la ruta según tu estructura de archivos

if (!file_exists($rutaImagen)) {
    die("Error: La imagen no existe en la ruta especificada.");
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function getNumericValue($value) {
        return is_numeric($value) ? (float)$value : 0;
    }

    $html = '<html>
                <head>
                    <meta charset="UTF-8">
                    <style>
                        body{ 
                            font-family: Arial, sans-serif;
                        }

                        table{
                            width: 100%;
                            border-collapse: collapse;
                            }
                            
                        .productos{
                            border: 1px solid rgb(254,214,107);
                        }

                        .productos tr:nth-child(odd){
                            background: rgb(255,241,204);
                        }

                        .valido{
                            position:absolute;
                            bottom: 0;
                            font-style: italic;
                            font-size: 12px;
                        }
                    </style>
                </head>
                <body>';


    $html .= '<table class="datos">
                <tr style="height: 40px;">
                    <td >
                        <b>Nombre: </b>' . $cliente['nombre'].  '
                    </td>
                    <td rowspan="4" style="text-align: right; background: #c2c2c2">
                        <img src="http://lucasconde.ddns.net/L-Red/assets/img/example.jpg" style="height: 120px; border: 1px solid black;"> 
                    </td>
                </tr>

                <tr style="height: 40px;">
                    <td>
                        <b>Apellido: </b>' . $cliente['apellido'].'
                    </td>
                </tr>

                <tr style="height: 40px;">
                    <td>
                        <b>Razón Social: </b>' . $cliente['razon'].'
                    </td>
                </tr>

                <tr style="height: 40px;">
                    <td>
                        <b>Fecha: </b>' . date('d/m/y') .'
                    </td>
                </tr>
            </table>';

    $html .= '<h2 style="text-align: center; margin-top: 50px">Presupuesto de instalación sistema DVR</h2>';
    $html .= '<table class="productos" style="margin-top: 50px">
                    <tr style="background: rgb(254,214,107);">
                        <th style="height: 40px;">Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>';

    $items = [
        ['DVR', getNumericValue($_POST['cantidad_dvr']), getNumericValue($_POST['producto_dvr']), getNumericValue($_POST['subtotal_dvr'] * $_POST['cantidad_dvr'])],
        ['Cámaras', getNumericValue($_POST['cantidad_camara']), getNumericValue($_POST['producto_camara']), getNumericValue($_POST['subtotal_camara'] * $_POST['cantidad_camara'])],
        ['Fichas Balun', getNumericValue($_POST['cantidad_balun']), getNumericValue($_POST['producto_balun']), getNumericValue($_POST['subtotal_balun'] * $_POST['cantidad_balun'])],
        ['Fuente', getNumericValue($_POST['cantidad_fuente']), getNumericValue($_POST['producto_fuente']), getNumericValue($_POST['subtotal_fuente'] * $_POST['cantidad_fuente'])],
        ['Caja Estanca', getNumericValue($_POST['cantidad_caja']), getNumericValue($_POST['producto_caja']), getNumericValue($_POST['subtotal_caja'] * $_POST['cantidad_caja'])],
        ['Balunera', getNumericValue($_POST['cantidad_balunera']), getNumericValue($_POST['producto_balunera']), getNumericValue($_POST['subtotal_balunera'] * $_POST['cantidad_balunera'])],
        ['Insumos', getNumericValue($_POST['cantidad_insumos']), getNumericValue($_POST['producto_insumos']), getNumericValue($_POST['subtotal_insumos'] * $_POST['cantidad_insumos'])],
        ['Cable UTP', getNumericValue($_POST['cantidad_utp']), getNumericValue($_POST['producto_utp']), getNumericValue($_POST['subtotal_utp'] * $_POST['cantidad_utp'])],
        ['Cable electrico', getNumericValue($_POST['cantidad_electrico']), getNumericValue($_POST['producto_electrico']), getNumericValue($_POST['subtotal_electrico'] * $_POST['cantidad_electrico'])],
        ['Rack Gabinete', getNumericValue($_POST['cantidad_rack']), getNumericValue($_POST['producto_rack']), getNumericValue($_POST['subtotal_rack'] * $_POST['cantidad_rack'])],
        ['Mano de Obra', getNumericValue($_POST['cantidad_mano']), getNumericValue($_POST['producto_mano']), getNumericValue($_POST['subtotal_mano'] * $_POST['cantidad_mano'])]
    ];

    foreach ($items as $item) {
        $cantidad = getNumericValue($item[1]);
        $precioUnitario = getNumericValue($item[2]);
        $subtotal = getNumericValue($item[3]);

        $precioFormateado = ($precioUnitario == 0) ? "-" : "$" . number_format($precioUnitario, 0, ',', '.');
        $subtotalFormateado = ($subtotal == 0) ? "-" : "$" . number_format($subtotal, 0, ',', '.');
        $cantidadFormateada = ($precioFormateado == "-" && $subtotalFormateado == "-") ? "-" : $cantidad;

        $html .= '<tr style="border-bottom: .1px solid rgb(254,214,107); text-align: center;">
                    <td style="height: 30px; padding-left: 10px; text-align: left;">'.$item[0]
                    .'</td>
                    <td>'.$cantidadFormateada.'</td>
                    <td>'.$precioFormateado.'</td>
                    <td>'.$subtotalFormateado.'</td>
                </tr>';
    }

    $totalGeneral = getNumericValue($_POST['total_general']);
    $html .= '<tr style="background: rgb(254,214,107); ">
                <th colspan="3" style="height: 40px; text-transform: uppercase;">Total</th>
                <th>$' . number_format($totalGeneral, 0, ',', '.') . '</th>
            </tr>';

    $html .= '</table>

        <p class="valido">PRESUPUESTO VÁLIDO POR 7 DIAS, UNA VEZ CADUCADO SOLICITELO NUEVAMENTE.</p>

        </body>
    </html>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    // Para visualizar cambiar 'attachment' a 'inline'
    // $dompdf->stream("Presupuesto.pdf", ["inline" => true]);
    $dompdf->stream("Presupuesto.pdf", ["Attachment" => false]);

} else {
    echo "Error: No se recibieron datos.";
}
?>