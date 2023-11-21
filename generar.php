<?php
session_start();
include ('phpqrcode/qrlib.php');


$filepath = 'qr/car/';
$filename = $filepath.'BC5097C.png';
$tamaño = 10;
$level = 'M';
$frame_size = 3;
$contenido = 'BC5097C';

QRcode::png($contenido,$filename,$level,$tamaño,$frame_size);

?>