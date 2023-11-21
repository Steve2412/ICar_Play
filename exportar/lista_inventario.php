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
    $query = "SELECT * FROM respuestos WHERE tipo = '$id'";
    $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
    $html = '';
    $html .= '
        <h2 align="center">Inventario de '.$id.' de ICar Play</h2>
        <div align="center">Reporte del dia '.$currentDate.' a las '.$currentHour.'</div>
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Nombre</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Numero</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Descripcion</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Cantidad</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Costo c/u Dolares</th>
            </tr>   
    ';
    foreach ($result as $row){
            $html .= '
            <tr>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['nombre'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['numero'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['descripcion'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['cantidad'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['costo'].'</td>

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
    $dompdf->stream("inventario_'$id'.pdf");

}
?>
