<?php
/* @var $this EstudioAtributoController */
/* @var $data EstudioAtributo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estudio')); ?>:</b>
	<?php echo CHtml::encode($data->id_estudio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_form')); ?>:</b>
	<?php echo CHtml::encode($data->id_form); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_attributo')); ?>:</b>
	<?php echo CHtml::encode($data->id_attributo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->valor); ?>
	<br />


</div>