<?php
/* @var $this EstudioAtributoController */
/* @var $model EstudioAtributo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'estudio-atributo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_estudio'); ?>
		<?php echo $form->textField($model,'id_estudio'); ?>
		<?php echo $form->error($model,'id_estudio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_form'); ?>
		<?php echo $form->textField($model,'id_form'); ?>
		<?php echo $form->error($model,'id_form'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_attributo'); ?>
		<?php echo $form->textField($model,'id_attributo'); ?>
		<?php echo $form->error($model,'id_attributo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textArea($model,'valor',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->