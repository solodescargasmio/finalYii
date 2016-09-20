<?php
/* @var $this AtributoController */
/* @var $data Atributo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_attributo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_attributo), array('view', 'id'=>$data->id_attributo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('calculado')); ?>:</b>
	<?php echo CHtml::encode($data->calculado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tabla')); ?>:</b>
	<?php 
	
	echo CHtml::encode($data->tabla); ?>
	<br />


</div>