<?php
/* @var $this EstudioPacienteController */
/* @var $data EstudioPaciente */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estudio')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_estudio), array('view', 'id'=>$data->id_estudio)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_paciente')); ?>:</b>
	<?php echo CHtml::encode($data->id_paciente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_estudio')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_estudio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero')); ?>:</b>
	<?php echo CHtml::encode($data->numero); ?>
	<br />


</div>