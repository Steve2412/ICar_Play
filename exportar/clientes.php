<?php
date_default_timezone_set('America/Caracas');
$currentDate = date('d-m-Y');
$currentHour = date('H:i');
session_start();
require "../assets/php/conexion.php";
$usuario = $_SESSION['usuario'];
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
extract($_POST);

if(isset($submit)){
    $query = "SELECT * FROM clientes";
    $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
    $html = '';
    $html .= '
        <h2 align="center">Clientes de ICar Play</h2>
        <div align="center">Reporte del dia '.$currentDate.' a las '.$currentHour.'</div>
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Cedula</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Nombre</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Correo</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Telefono</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Direccion</th>
            </tr>   
    ';
    foreach ($result as $row){
            $html .= '
            <tr>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['cedula'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['nombre'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['correo'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['telefono'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['direccion'].'</td>

            </tr>
        ';

}
    $html .= '</table>';
    $dompdf = NEW DOMPDF();
    $dompdf->loadHtml($html);
    $dompdf->setPaper("A4","landscape");
    $dompdf->render();
    $canvas = $dompdf->get_canvas(); 
    $canvas->page_text(400, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}",null, 13, array(0,0,0)); 
    $dompdf->stream("clientes.pdf");

}
?>
