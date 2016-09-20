<script type="text/javascript">
$(document).ready(function(){


$('input[name=edad]').click(function(){
     
           var value=document.getElementById("datepicker").value;

          var dato=calcular_edad(value);
          document.getElementById("edad").value=dato;
    });

function vacio(e){
       ok=true;
       patron =/\w/;
       k=e.which;
       if (k==8 || k==0) return true;
       n = String.fromCharCode(k);
return patron.test(n);
 /*if((k < 97 || k > 122) && (k < 65 || k > 90) && (k !== 16||k !== 8||k !== 242)){
       alert("No agrege espacios en blanco ni caracteres raros \n si quiere escribir varias palabras unalas con guión bajo '_'");
ok=false; 
        }
return ok;*/
    }

    
    
    function calcular_imc(peso,altura){
        var $indice=peso/(altura*altura);
        return $indice;
    }
 function calcular_edad(fecha) {
var fechaActual = new Date()
var diaActual = fechaActual.getDate();
var mmActual = fechaActual.getMonth() + 1;
var yyyyActual = fechaActual.getFullYear();
FechaNac = fecha.split("-");
var diaCumple = FechaNac[2];
var mmCumple = FechaNac[1];
var yyyyCumple = FechaNac[0];

//retiramos el primer cero de la izquierda
if (mmCumple.substr(0,1) == 0) {
mmCumple= mmCumple.substring(1, 2);
}
//retiramos el primer cero de la izquierda
if (diaCumple.substr(0, 1) == 0) {
diaCumple = diaCumple.substring(1, 2);
}
var edad = yyyyActual - yyyyCumple;

//validamos si el mes de cumpleaños es menor al actual
//o si el mes de cumpleaños es igual al actual
//y el dia actual es menor al del nacimiento
//De ser asi, se resta un año
if ((mmActual < mmCumple) || (mmActual == mmCumple && diaActual < diaCumple)) {
edad--;
}

return edad;
};  
});
</script>
<h3>Formulario :</h3>
<?php 
require_once('claves.php');
$id_estudio=Yii::app()->getsession()->get('id_estudio');
$form=Form::model()->find('id_form='.$idform); ?>
  <div class="form">
  <form class="form" method="POST" enctype="multipart/form-data">
    <fieldset><legend><font style="font-size: x-large;"><?php echo ucwords($form->nombre); ?></font></legend></fieldset>
 <div class="row">
 <input type="text" name="nomformulario" id="nomformulario" value="<?php echo $form->nombre; ?>" hidden="" >
</div>
<?php foreach ($estudio as $key => $value) { //recorro los atributos del estudio
  $atr=Atributo::model()->find('id_attributo='.$value->id_attributo);
 //obtengo todos los datos del atributo con id_att...
   /*
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

   */


   ?>
   
<div class="row">
        <label> <?php echo ucwords($atr->nombre);  ?>
         <div id="respuestauser" style="float:rigth;"></div></label>
         <?php if($atr->tabla==1){ //si el atr tiene opciones, muestro esas opciones ?>
         <select name="<?php echo $atr->nombre; ?>">
          
         
          <?php $tabla=Tabla::model()->findAllByAttributes(array('id_attributo' => $atr->id_attributo));
          foreach ($tabla as $key => $tab) { ?>
          <option value="<?php echo $tab->opcion; ?>" 
            <?php if(strcmp($tab->opcion, $value->valor)==0){echo "selected=selected";} //dejo seleccionada la opcion del formulario, entonces modifico solo si se modifica ?>
          ><?php echo ucwords($tab->opcion); ?></option>
            
          <?php }//fin for recorro tabla ?>
</select>
          <?php
          } else{

//////////////////////////////////////////////////////////////////////////////////////
if(strcmp($atr->tipo,"file")==0){
  echo '<div style="float:lefth;">';
 $id_paciente=Yii::app()->getsession()->get('id_paciente');
     $estudio=EstudioPaciente::model()->find('id_estudio='.$id_estudio);
    $es=$estudio->numero; //obtengo numero del estudio para crear la carpeta

  $exte=explode('.',$value->valor);
  $ex=end($exte);

   if((strcmp($ex,"avi")==0)||(strcmp($ex,"mp4")==0)||(strcmp($ex,"wmv")==0)||(strcmp($ex,"mkv")==0)||(strcmp($ex,"3gp")==0)){  ?>             
 
            <video width="250" height="120" controls>
  <source src="<?php echo RutaMostrar.$id_paciente."/".$estu."/".$exte[0].'.webm';?>" type="video/webm">
Tu navegador no soporta este tipo de video.
</video> 
<?php //CHtml::image("../".$exte[0].'.webm',"imagen", array("width"=>300, "height"=>300)); 
}else if(strcmp($ex,"png")==0){  
 echo CHtml::image(RutaMostrar.$id_paciente."/".$es."/".$value->valor,"imagen", array("width"=>80, "height"=>80));
  ?>
<?php }else{
  echo "<h4><font style=color:green;>No puede reproducir el archivo.</font></h4>";
}
       } echo "</div>";
       ?>
       <?php
//////////////////////////////////////////////////////////////////////////////////////
           //fin if(tabla) y comienzo sino es tabla ?>
 <input type="<?php echo $atr->tipo; ?>" name="<?php if(strcmp($atr->tipo,"file")==0){ echo "archivo[]";}else{echo $atr->nombre; } ?>" 
 id="<?php if(strcmp($atr->tipo,'date')==0){ echo 'datepicker'; }else{ echo $atr->nombre;} ?>" value="<?php echo $value->valor; ?>">
<?php }// fin else if($tabla)

 } //fin for recorro los datos del estudio

 foreach ($form_att as $key => $value) { //esto es para traer los campos q están en el form pero q no fuero llenados
  //el no "fueron llenados refiere a q no eran obligatorios"
       $estudiop = Yii::app()->db->createCommand("SELECT id FROM estudio_atributo WHERE id_estudio=".$id_estudio." AND id_form=".$idform." AND id_attributo=".$value->id_attributo)->queryRow();
$id_attribut = $estudiop["id"];
if(is_null($id_attribut)){ //si el id es null significa q no está en estudio_atributo
  //por lo q no fue llenado
 $atr=Atributo::model()->find('id_attributo='.$value->id_attributo);
 //obtengo todos los datos del atributo con id_att...
   ?>
   
<div class="row">
        <label> <?php echo ucwords($atr->nombre);  ?>
         <div id="respuestauser" style="float:rigth;"></div></label>
         <?php if($atr->tabla==1){ //si el atr tiene opciones, muestro esas opciones ?>
         <select name="<?php echo $atr->nombre; ?>">
          <?php $tabla=Tabla::model()->findAllByAttributes(array('id_attributo' => $atr->id_attributo));
          foreach ($tabla as $key => $tab) { ?>
          <option value="<?php echo $tab->opcion; ?>">
          <?php echo ucwords($tab->opcion); ?></option>
          <?php }//fin for recorro tabla ?>
</select>
          <?php
          } else{ //fin if(tabla) y comienzo sino es tabla ?>
 <input type="<?php echo $atr->tipo; ?>" name="<?php echo $atr->nombre; ?>" 
 id="<?php if(strcmp($atr->tipo,'date')==0){ echo 'datepicker'; }else{ echo $atr->nombre;} ?>">
<?php } 
}

 }
?> 
</div>
<div class="row">
 <input type="submit" value="Modificar datos">
</div>
<script type="text/javascript">
var nav = navigator.userAgent.toLowerCase(); //obtengo el navegador del usuario
if(nav.search(/chrome/g) > 0){ //si la palabra chrome se encuentra en nav
  //si es chrome, que no muestre el calendario datepicker y no genere conflicto con el tipo date de chrome
}else{

       $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<<Ant    ',
 nextText: '     Sig>>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd-mm-yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#datepicker").datepicker(
        {
firstDay: 1,
onSelect: function (date) {
},
} );

}); }
</script>