<?php
/* @var $this AdministradorController */
/* @var $model administrador */
/* @var $form CActiveForm */
?>

<?php 
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/sha1.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('control', '
	$(document).ready(function(){
$("#administrador_nick").on("blur",function(){
var nick=$.trim(document.getElementById("administrador_nick").value);
datatypo="nick="+nick;
		$.ajax({
         url: "index.php?r=administrador/controlNick",
         type:"POST",
         data:datatypo,
             success:function(data){ 
                 if((data!=0)){  
                 alert("El nick existe en sistema, ingrese uno distinto");	
                 document.getElementById("administrador_nick").value="";  
                              }          
                                      }
                }); 
             });



		$("#administrador_pass").on("blur",function(){
			var sha=document.getElementById("administrador_pass").value;
          var pass=sha1(sha);
 alert("La Pass sera encriptada");
 document.getElementById("administrador_pass").value=pass;
		});
	});
	');

?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'administrador-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nick'); ?>
		<?php echo $form->textField($model,'nick',array('size'=>40,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nick'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>40,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido'); ?>
		<?php echo $form->textField($model,'apellido',array('size'=>40,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'apellido'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pass'); ?>
		<?php echo $form->passwordField($model,'pass',array('size'=>40,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'pass'); ?>
	</div>
    <?php if($update!=1){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php echo $form->dropDownList($model, 'tipo', array('0'=>'Administrador', '1'=>'Usuario Común'));  ?>
		<?php echo $form->error($model,'tipo'); ?>
	</div>
<?php } ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->