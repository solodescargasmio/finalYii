<?php
/* @var $this EstudioAtributoController */
/* @var $model EstudioAtributo */
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
		<?php echo $form->label($model,'id_estudio'); ?>
		<?php echo $form->textField($model,'id_estudio'); ?>
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
		<?php echo $form->label($model,'valor'); ?>
		<?php echo $form->textArea($model,'valor',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->