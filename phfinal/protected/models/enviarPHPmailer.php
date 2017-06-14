<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of enviarPHPmailer
 *
 * @author pico
 */
require_once('class.phpmailer.php');
class enviarPHPmailer {
    public function enviar() {
   
    $ok=true;
    
$mail = new PHPMailer;
var_dump('otra ves dentro');
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "tugmail@gmail.com";
$mail->Password = "tu passs";
$mail->SMTPSecure = 'tls';
$mail->From       = "correo destino@hotmail.com";
$mail->FromName   = 'Sistema de gestion de
Estudios Medicos 
Heterogeneos'; 

$mail->addAddress("correo destino@hotmail.com", "Yo" ."  El");
$mail->WordWrap   = 50;
$mail->isHTML(true);
$mail->Subject= "Probar envio";    
$mail->Body= "Este es un envio de prueba";
$mail->AltBody ="Este es un envio de prueba";
$mail->Port=587;

if(!$mail->send()) {
   $ok=false;
}
//var_dump($mail);exit();
return $ok;
    }
}
