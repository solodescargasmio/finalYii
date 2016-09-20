<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('claves.php'); //en este archivo están las pass y user de ftp, BD, etc...
require_once ('crearMKdir.php');//este archivo es para crear los directorios
function subirDatos($id_form){ 
      
   // error_reporting(1);
    $id_paciente=Yii::app()->getsession()->get('id_paciente');
    $id_estudio=Yii::app()->getsession()->get('id_estudio');
    $estudio=EstudioPaciente::model()->find('id_estudio='.$id_estudio);
    $var="";
    $arch="";
    $ok=false;
    $estu=$estudio->numero; //obtengo numero del estudio para crear la carpeta
     $sql="SELECT atributo.nombre FROM atributo,form_attr WHERE form_attr.id_attributo=atributo.id_attributo AND form_attr.id_form=$id_form AND atributo.tipo='file'";
 $estudios=Atributo::model()->findAllBySql($sql); 

      if($_FILES["archivo"]["name"]){   
        for($i=0;$i<count($_FILES["archivo"]["name"]);$i++){ //recorro los archivos que vengan
         $contador=0; //esto es para saber si el archivo q viene corresponde al atributo del form
                    foreach ($estudios as $key => $value) { //recorro los atributos tipo file del form
                      if($contador==$i){                        
                        $var=$value->nombre; //$var vá a ser el nombre del archivo
                      }
                      $contador++;
             
           if(strcmp($_FILES["archivo"]["name"][$i],"")!=0){ //si el file no viene vacio
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////

              $arch=$_FILES["archivo"]["name"][$i];
 $directorio = Ruta.'/'.$id_paciente.'/'.$estu; //creo una ruta para guardar los archivos en ese lugar
   
if (!file_exists($directorio)) { //si el directorio no existe, lo creamos
  $dir=$id_paciente.'/'.$estu;
    crearDir($dir);
} //fin if (!file_exists($directorio))
   $serv =Ruta.'/'.$id_paciente.'/'.$estu.'/'; //esta ruta es para guardar el archivo

  $exten=explode(".",$_FILES['archivo']['name'][$i]);
        $ex=end($exten);
       $origi=$var.".".$ex;     
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

    // Verificamos si ya se subio el archivo temporal
  if (is_uploaded_file($remoto)){

                       //guardamos nombre en base de datos        
                  if(strcasecmp($ex, "jpeg")==0){
            $newpng =$var.'.png'; 
             $png = imagepng(imagecreatefromjpeg($_FILES['archivo']['tmp_name'][$i]), $newpng);
             $ruta = $serv.$newpng;
             copy($remoto, $ruta);
             $ex="png";
                  }else
                    if(strcasecmp($ex, "jpg")==0){
               $newpng =$var.'.png'; 
             $png = imagepng(imagecreatefromjpeg($_FILES['archivo']['tmp_name'][$i]), $newpng);
             $ruta = $serv.$newpng;
             copy($remoto, $ruta);
             $ex="png";
                  }else
                   if(strcasecmp($ex, "gif")==0){
             $newpng =$var.'.png'; 
             $png = imagepng(imagecreatefromgif($_FILES['archivo']['tmp_name'][$i]), $newpng);
             $ruta = $serv.$newpng;
             copy($remoto, $ruta);
             $ex="png";    
             }else
                         if(strcasecmp($ex, "bmp")==0){
             $newpng =$var.'.png'; 
             $png = imagepng(imagecreatefromwbmp($_FILES['archivo']['tmp_name'][$i]), $newpng);
             $ruta = $serv.$png;
             copy($remoto, $ruta);
             $ex="png";           
                         }else
      if(strcmp($ex,"avi")==0||strcmp($ex,"mp4")==0||strcmp($ex,"wmv")==0||strcmp($ex,"mkv")==0||strcmp($ex,"3gp")==0){
//var_dump("dentro del if");exit();            
 $newpng=$var.".".$ex;
 
                                copy($remoto, $ruta);  
         $video=exec("ffmpeg -i ".$remoto." -ss 00:00:00 -t 00:01:00 -async 1 ".Ruta."/$id_paciente/$estu/".$var.".webm 2>&1");
                

         }else{
             $newpng=$origi;
             copy($remoto, $ruta);
         }

       showFiles('./',$newpng);   //funcion que elimina los archivos creados en la raiz de la aplicacion
         ////-vcodec copy -ss 1 -t 120 -acodec //corta los videos
                          //  exec("ffmpeg -i ".$remoto." ./multimedia/$id_user/".$varia.".webm 2>&1");
                // copiamos el archivo temporal, del directorio de temporales de nuestro servidor a la ruta que creamos   
                        //////////////////////////////////////////////////
           $estatr=new EstudioAtributo;
    $estatr->isNewRecord = true; //Esto es importante, indica que es un nuevo modelo, sino guarda solo el ultimo.
    $estatr->id_estudio=$id_estudio;
    $estatr->id_form=$id_form;
    $estudiop = Yii::app()->db->createCommand("SELECT id_attributo FROM atributo WHERE nombre='".$var."'")->queryRow();
$id_attributo = $estudiop["id_attributo"];
$estatr->id_attributo =$id_attributo;
$estatr->valor = $newpng;

         
                        if($estatr->save()){
                          $ok=true;
                        }else{
                            echo "Error al guardar archivo, verifique";
                        } //fin if($estudio->ingresarEstudioForm())
                    ///////////////////////////////////////////////////////  
    } 
    else {// Sino se pudo subir el temporal
      echo "no se pudo subir el archivo ".$local;
    }//fin if (is_uploaded_file($remoto))

  //cerramos la conexión FTP
  ftp_close($cid);                       

      ///////////////////////////////////////////////////////////////////////////////////////////////////////////               

               
                  }//fin if (strcmp($_FILES["archivo"]["name"][$i],"")==0)             
                      
                     } //fin  foreach ($estudios as $key => $value)

              
                 }//fin for for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)        

   
         }//fin If($_FILES[archivo][name])
     return $ok;
  }//fin de la funcion

function showFiles($path,$var){ //esta funcion permite eliminar los archivos
  //q se duplican en la raiz del proyecto, esto es porq la funcion ftp_chdir($cid, $serv) que es para movernos hacia
  //la carpeta donde iran guardados los archivos no sirve si los archivos son almacenados en otra unidad de disco,
  // si van a guardar en la misma unidad, descomenten la funcion ftp_chdir($cid, $serv)
  // y eliminen esta funcion ya que no es necesaria
    $dir = opendir($path);
    $files = array();
    while ($current = readdir($dir)){
        if( $current != "." && $current != "..") {
            if(is_dir($path.$current)) {
            }
            else {
                $files[] = $current;
            }
        }
    }
    for($i=0; $i<count( $files ); $i++){
        if(strcmp($files[$i],$var)==0){
        unlink($files[$i]);
        }
        
    }
}