<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('claves.php'); //en este archivo están las pass y user de ftp, BD, etc...
require_once ('crearMKdir.php');//este archivo es para crear los directorios
require_once ('guardarMultimedia.php');//este archivo es para crear los directorios
function eliminarDirectorio($carpeta)
{   
 $id_paciente=Yii::app()->getsession()->get('id_paciente');
    $id_estudio=Yii::app()->getsession()->get('id_estudio'); 
    foreach(glob($carpeta."/*") as $archivos_carpeta)
    {  
        if (is_dir($archivos_carpeta))
        {
           
            eliminarDirectorio($archivos_carpeta);
        }
        else
        {
  
   unlink($archivos_carpeta);
        }
    }  
    rmdir($carpeta);
}

function eliminarFormulario($idf){
             Session::init();
    $id_user=Session::get('cedula');
    $id_estudio= Session::get("estudio");
    $carpeta=Ruta."/".$id_user."/".$id_estudio;
  $attr=new atributo();
    $attribu=$attr->traerAtributosFormFile($idf);
         foreach ($attribu as $key => $value) {
           $nombre=$value->getNombre();       
    foreach(glob($carpeta."/*") as $archivos_carpeta)
    { 
         
        if (is_dir($archivos_carpeta))
        { 
        }
        else
        {
     $exten=explode(".",$archivos_carpeta);
            $nom=  explode("/", $exten[1]);
            $nomb=end($nom);
            
            if(strcmp($nomb,$nombre)==0){ 
         unlink($archivos_carpeta);
            }
        }
    }
 
}
}




function eliminarArchivo($idf){

    $nombre="";// este es el nombre que tendrá el archivo a guardar
    $id_user=Yii::app()->getsession()->get('id_paciente');
    $id_estudio=Yii::app()->getsession()->get('id_estudio');
    $estudio=EstudioPaciente::model()->find('id_estudio='.$id_estudio); 
     $estu=$estudio->numero; //obtengo numero del estudio para crear la carpeta
    $carpeta=Ruta.$id_user."/".$estu;
    //obtengo los atributos del formulario
    $attribu=FormAttr::model()->findAllByAttributes(array('id_form' => $idf));
    $cont=0;
        for($i=0;$i<count($_FILES["archivo"]["name"]);$i++){ //recorro los archivos que vengan
  foreach ($attribu as $key => $value) { 

         $attr=Atributo::model()->find("id_attributo=".$value->id_attributo);
         $nombre=$attr->nombre;
         if(strcmp($attr->tipo,"file")==0){
             if(strcmp($_FILES["archivo"]["name"][$i],"")!=0){

                if($cont==$i){
                    
 foreach(glob($carpeta."/*") as $archivos_carpeta){ 
 
     $exten=explode(".",$archivos_carpeta);
            $nom=  explode("/", $exten[1]);
            $nomb=end($nom); 
            if(strcmp($nomb,$nombre)==0){ 
        unlink($archivos_carpeta);  //elimino el archivo
        //si es video, borra el original y el webm
           } //fin if(strcmp($nomb,$nombre)==0)
//////////////////////////////////////////////////////////////////////////////////////////////////
    $serv =Ruta.'/'.$id_user.'/'.$estu.'/'; //esta ruta es para guardar el archivo
     //   var_dump($_FILES['archivo']['name'][$i]);exit();         
  $exten=explode(".",$_FILES['archivo']['name'][$i]);
        $ex=end($exten);
       $origi=$nombre.".".$ex;     
    // Primero creamos un ID de conexión al servidor
  // Comprobamos que se creo el Id de conexión y se pudo hacer el login
  $cid = ftp_connect(FTP_HOST);
 
  // Luego creamos un login al mismo con nuestro usuario y contraseña
  $resultado = ftp_login($cid, FTP_USR,FTP_PASS);
  // Comprobamos que se creo el Id de conexión y se pudo hacer el login
  if ((!$cid) || (!$resultado)) {
    echo "Fallo en la conexión"; die;
  }

  // Cambiamos a modo pasivo, esto es importante porque, de esta manera le decimos al 
  //servidor que seremos nosotros quienes comenzaremos la transmisión de datos.
  ftp_pasv ($cid, true) ;
  // Nos cambiamos al directorio, donde queremos subir los archivos, si se van a subir a la raíz
  // esta por demás decir que este paso no es necesario.

/*
  ftp_chdir($cid, $serv); 
*/
  // Tomamos el nombre del archivo a transmitir, pero en lugar de usar $_POST, usamos $_FILES que le indica a PHP
  // Que estamos transmitiendo un archivo, esto es en realidad un matriz, el segundo argumento de la matriz, indica
  // el nombre del archivo
  $local =$origi;    
  // Este es el nombre temporal del archivo mientras dura la transmisión
  $remoto = $_FILES["archivo"]["tmp_name"][$i]; //si no mando un array, me da error en is_upload_...
  // Juntamos la ruta del servidor con el nombre real del archivo
  $ruta = $serv.$local;
    // $upload = ftp_put($cid, $serv, $_FILES['archivo']['tmp_name'][0], FTP_BINARY); 
 if (is_uploaded_file($remoto)){

                       //guardamos nombre en base de datos        
                  if(strcasecmp($ex, "jpeg")==0){
            $newpng =$nombre.'.png'; 
             $png = imagepng(imagecreatefromjpeg($_FILES['archivo']['tmp_name'][$i]), $newpng);
             $ruta = $serv.$newpng;
             copy($remoto, $ruta);
             $ex="png";
                  }else
                    if(strcasecmp($ex, "jpg")==0){
               $newpng =$nombre.'.png'; 
             $png = imagepng(imagecreatefromjpeg($_FILES['archivo']['tmp_name'][$i]), $newpng);
             $ruta = $serv.$newpng;
             copy($remoto, $ruta);
             $ex="png";
                  }else
                   if(strcasecmp($ex, "gif")==0){
             $newpng =$nombre.'.png'; 
             $png = imagepng(imagecreatefromgif($_FILES['archivo']['tmp_name'][$i]), $newpng);
             $ruta = $serv.$newpng;
             copy($remoto, $ruta);
             $ex="png";    
             }else
                         if(strcasecmp($ex, "bmp")==0){
             $newpng =$nombre.'.png'; 
             $png = imagepng(imagecreatefromwbmp($_FILES['archivo']['tmp_name'][$i]), $newpng);
             $ruta = $serv.$png;
             copy($remoto, $ruta);
             $ex="png";           
                         }else
      if(strcmp($ex,"avi")==0||strcmp($ex,"mp4")==0||strcmp($ex,"wmv")==0||strcmp($ex,"mkv")==0||strcmp($ex,"3gp")==0){
//var_dump("dentro del if");exit();            
 $newpng=$nombre.".".$ex;
 
                                copy($remoto, $ruta);  
         $video=exec("ffmpeg -i ".$remoto." -ss 00:00:00 -t 00:01:00 -async 1 ".Ruta."/$id_user/$estu/".$nombre.".webm 2>&1");
                

         }else{
             $newpng=$origi;
             copy($remoto, $ruta);
         }
        
       showFiles('./',$newpng);   //funcion que elimina los archivos creados en la raiz de la aplicacion
        //////////////////////////////////////////////////////////////////
          $estudiop = Yii::app()->db->createCommand("SELECT id FROM estudio_atributo WHERE id_estudio=".$id_estudio." AND id_form=".$idf." AND id_attributo =".$attr->id_attributo)->queryRow();
$id = $estudiop["id"];
      if(!is_null($id)){ //id distinto de null = existe en bd
         Yii::app()->db->createCommand("UPDATE estudio_atributo SET valor = '".$newpng."' WHERE  id =".$id)->query();
       }
    } 
    else {// Sino se pudo subir el temporal
      echo "no se pudo subir el archivo ".$local;
    }//fin if (is_uploaded_file($remoto))   


      ///////////////////////////////////////////////////////////////////////////////////////////////////////////                       

     
        
    } //fin foreach(glob($carpeta."/*") as $archivos_carpeta)


                }// fin if($cont==$i)
             } //fin if(strcmp($_FILES["archivo"]["name"][$i],"")!=0)
        $cont++; }//if(strcmp($attr->tipo,"file")==0)
  } //fin foreach ($attribu as $key => $value) 

     }// fin for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)

}




