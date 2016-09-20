<?php
/* @var $this FormAttrController */
/* @var $model FormAttr */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'form-attr-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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
		<?php echo $form->labelEx($model,'obligatorio'); ?>
		<?php echo $form->textField($model,'obligatorio'); ?>
		<?php echo $form->error($model,'obligatorio'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->