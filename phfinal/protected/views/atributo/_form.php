<?php
/* @var $this AtributoController */
/* @var $model Atributo */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScript('search', '
	$(document).ready(function(){
		var valor=$("select[id=Atributo_tabla]").val();
		if(valor==0){
           $("#opcion").hide();
		}
		

$("select[id=Atributo_tabla]").on("change",function(){
	var valor=$("select[id=Atributo_tabla]").val();
		if(valor==1){
           var tipo=$("select[id=Atributo_tipo]").val();
   if(tipo=="text"){
   	$("#opcion").show();
   }else{  $("#opcion").hide(); }
		}else{
      $("#opcion").hide();
		}
});

$("select[id=Atributo_tipo]").on("change",function(){
var tipo=$("select[id=Atributo_tipo]").val();
   if(tipo=="text"){
   	$("#opcion").show();
   }else{
   	 $("#opcion").hide();
   }
});

 $("#Atributo_nombre").on("blur",function(){

        nomb_atr=document.getElementById("Atributo_nombre").value;
      datatypo="attr="+nomb_atr;

          $.ajax({
         url: "index.php?r=atributo/controlAtributo",
         type:"POST",//metodo por el cual paso el dato
         data:datatypo,
             success: function (data) { 
                 if(data!=0){  
                 alert("El atributo ya existe en el sistema.");	
                 document.getElementById("Atributo_nombre").value="";
                 
                   }           
    }
     });  
    });

});
'); 

if((strcmp($model->nombre,"id_paciente")==0)||(strcmp($model->nombre,"fecha_nac")==0)||(strcmp($model->nombre,"edad")==0)||(strcmp($model->nombre,"peso")==0)||(strcmp($model->nombre,"altura")==0)||(strcmp($model->nombre,"imc")==0)||(strcmp($model->nombre,"realizado_por")==0)||(strcmp($model->nombre,"fecha_estudio")==0)){
	echo '<font style="font-weight: bold; color: red;">Este atributo es importante para el funcionamiento del sistema.<br>No se puede modificar. Gracias</font>';
}else{

 ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'atributo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php echo $form->dropDownList($model, 'tipo', array('text'=>'Texto', 'int'=>'Numero entero','double'=>'Numero decimal', 'date'=>'Fecha','file'=>'Archivo')); ?>
		<?php echo $form->error($model,'tipo'); ?>
	</div>

	<div class="row" hidden>
		<?php echo $form->labelEx($model,'calculado'); ?>
		<?php echo $form->dropDownList($model, 'calculado', array('1'=>'Si', '0'=>'No'));  ?>
		<?php echo $form->error($model,'calculado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tabla'); ?>
		<?php echo $form->dropDownList($model, 'tabla', array('0'=>'Atributo Simple', '1'=>'Atributo Compuesto'));  ?>
		<?php echo $form->error($model,'tabla'); ?>
	</div>
<div class="row" id="opcion">
<?php
$tab=new Tabla;
if(!is_null($model->id_attributo)){
    $tabla=Tabla::model()->findAll("id_attributo=".$model->id_attributo);
   $total=count($tabla);
if(!is_null($tabla)){ ?>

<?php    
            $arreglo="";
			$con=0;
      foreach ($tabla as $key => $value) {
      $con=$con+1;
      	$arreglo.=$value->opcion;
      	if($con<$total){
      		$arreglo.=",";
      	}
      }
      $tab->opcion=$arreglo;
			 ?>
       
		<?php echo $form->labelEx($tab,'opcion'); ?>
		<?php echo $form->textarea($tab, 'opcion');  ?>
		<?php echo $form->error($tab,'opcion'); ?>
	
    <?php } 
    }else{ ?>
    	<?php echo $form->labelEx($tab,'opcion'); ?>
		<?php echo $form->textarea($tab, 'opcion',array('placeholder' => 'masculino, femenino, etc...'));  ?>
		<?php echo $form->error($tab,'opcion'); ?>
  <?php  }
    ?>
</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php } ?>