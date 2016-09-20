<?php
/* @var $this FormAttrController */
/* @var $model FormAttr */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_form'); ?>
		<?php echo $form->textField($model,'id_form'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_attributo'); ?>
		<?php echo $form->textField($model,'id_attributo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'obligatorio'); ?>
		<?php echo $form->textField($model,'obligatorio'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->