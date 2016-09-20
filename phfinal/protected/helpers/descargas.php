<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('claves.php');
  function descargarArchivo($archivo){
  $id_paciente=Yii::app()->getsession()->get('id_paciente');
    $id_estudio=Yii::app()->getsession()->get('id_estudio');
     $estudio=EstudioPaciente::model()->find('id_estudio='.$id_estudio);
    $estu=$estudio->numero; //obtengo numero del estudio para crear la carpeta 
    $ruta=Ruta.$id_paciente.'/'.$estu.'/'.$archivo;
    var_dump($ruta);
 var_dump(is_file($ruta));

  var_dump("existe la ruta");
   header('Content-Type: application/force-download');
   header('Content-Disposition: attachment; filename='.$archivo);
   header('Content-Transfer-Encoding: binary');
   header('Content-Length: '.filesize($ruta));

   readfile($ruta);



}