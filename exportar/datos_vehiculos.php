<?php
date_default_timezone_set('America/Caracas');
$currentDate = date('d-m-Y');
$currentHour = date('H:i');
session_start();
$id=$_GET['id']; 
require "../assets/php/conexion.php";
$usuario = $_SESSION['usuario'];
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
extract($_POST);

if(isset($submit)){
    $query = "SELECT * FROM vehiculos WHERE modelo = '$id' AND estado = 'stock'";
    $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
    $html = '';
    $html .= '
        <h2 align="center">Inventario de '.$id.' de ICar Play</h2>
        <div align="center">Reporte del dia '.$currentDate.' a las '.$currentHour.'</div>
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Marca</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Año</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">VIN</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Maticula</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Tipo</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Precio Dolares</th>
            </tr>   
    ';
    foreach ($result as $row){
            $html .= '
            <tr>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['marca'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['año'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['vin'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['matricula'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['tipo'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['precio'].'</td>

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
    $dompdf->stream("vehiculos_'$id'.pdf");

}
?>
