

<div class="view">
<?php 
require_once('claves.php');
require_once("descargas.php");
 $id_paciente=Yii::app()->getsession()->get('id_paciente');
    $id_estudio=Yii::app()->getsession()->get('id_estudio');
     $estudio=EstudioPaciente::model()->find('id_estudio='.$id_estudio);
    $estu=$estudio->numero; //obtengo numero del estudio para crear la carpeta

foreach ($estudio_atributo as $key => $value) { ?>
	<?php
 $est = Yii::app()->db->createCommand("SELECT * FROM atributo WHERE  id_attributo='".$value->id_attributo."'")->queryRow();
$nombre = $est["nombre"]; ?>
<b><?php echo CHtml::encode(ucwords($nombre))?>:</b>
  <?php echo CHtml::encode(ucwords($value->valor))?>
  <br />
	<?php
 if(strcmp($est["tipo"],"file")==0){
 	$exte=explode('.',$value->valor);
 	$ex=end($exte);

   if((strcmp($ex,"avi")==0)||(strcmp($ex,"mp4")==0)||(strcmp($ex,"wmv")==0)||(strcmp($ex,"mkv")==0)||(strcmp($ex,"3gp")==0)){  ?>             
 
            <video width="250" height="120" controls>
  <source src="<?php echo RutaMostrar.$id_paciente."/".$estu."/".$exte[0].'.webm';?>" type="video/webm">
Tu navegador no soporta este tipo de video.
</video> 
<?php //CHtml::image("../".$exte[0].'.webm',"imagen", array("width"=>300, "height"=>300)); 
}else if(strcmp($ex,"png")==0){  
 echo CHtml::image(RutaMostrar.$id_paciente."/".$estu."/".$value->valor,"imagen", array("width"=>300, "height"=>300));
  ?>
<?php }else{
  echo "<h4><font style=color:green;>No puede reproducir el archivo, descargalo y visualizarlo en tu pc.</font></h4>";
}
   echo CHtml::link('Descargar Archivo',array('ctrl_dinamico/descargar', 'nom_archivo'=>$value->valor));
       }
	} //fin foreach 
echo "<br><br>";
echo CHtml::link('Modificar datos',array('ctrl_dinamico/recibeform', 'dato' => $nom_form));
  ?>
 

</div>