<?php
/* @var $this FormController */
/* @var $data Form */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_form')); ?>:</b>
	<?php echo CHtml::encode($data->id_form); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('version')); ?>:</b>
	<?php echo CHtml::encode($data->version); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_crea')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_crea); ?>
	<br />


</div>