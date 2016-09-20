<?php
/* @var $this DependenciaController */
/* @var $data Dependencia */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('depende')); ?>:</b>
	<?php echo CHtml::encode($data->depende); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('de')); ?>:</b>
	<?php echo CHtml::encode($data->de); ?>
	<br />


</div>