<?php
// configuracion de la Base de Datos en phpmyadmin
	define("DB_HOST", "localhost");//servidor
	define("DB_USR", "root");//usuario del server
	define("DB_PASS", "");//pass: yo no uso
	define("DB_DB", "phpfinal");//nombre BD
  
 //a continuacion configuracion de Servidor FTP : es obligatoria.         
        define("FTP_HOST", "localhost");//servidor
	define("FTP_USR", "Tu usuario FTP");//usuario del server
	define("FTP_PASS", "Tu pass FTP");//pass
        
        
 //correo para el olvido de contraseña (correo que se usa para enviar, debe ser gmail)
        define("Email_HOST",'smtp.gmail.com');
        define("Email",'Tu email');
        define("Epass", 'Tu pass');
        
//rutas para las carpetas (Aca se generan las carpetas que guardan los videos, imagenes, ect.)       
define("Ruta","./multimedia/"); //esta ruta se usa para la descarga
define("RutaMostrar",Yii::app()->baseUrl."/multimedia/"); //esta ruta se usa para la visualizacion
?>
