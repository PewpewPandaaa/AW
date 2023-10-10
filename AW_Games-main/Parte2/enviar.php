<?php
header("Content-type: text/html;charset=\"utf-8\"");
$nombre = $_POST['nombre'];
$mail = $_POST['email'];
$telefono = $_POST['telefono'];
$asunto = $_POST['asunto'];
$empresa = $_POST['mensaje'];

$header = 'From: ' . $mail . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

$mensaje = "Este mensaje fue enviado por " . $nombre . ",\r\n";
$mensaje .= "Su e-mail es: " . $mail . " \r\n";
$mensaje .= "Asunto: " . $asunto . " \r\n";
$mensaje .= "Teléfono: " . $telefono . " \r\n";
$mensaje .= "Mensaje: " . $empresa . " \r\n";
$mensaje .= "Enviado el " . date('d/m/Y', time());

$para = 'sishichen010516@gmail.com';
$asunto = 'Mensaje de AWSD';

if (mail($para, $asunto, $mensaje, $header)){
    echo "<script type='text/javascript'>alert('Tu mensaje ha sido enviado exitosamente');</script>";
    echo "<script type='text/javascript'>window.location.href='http://localhost/AW_Games/Parte2/index.php';</script>";
}else{
    echo "<script type='text/javascript'>alert('No');</script>";

}

?>