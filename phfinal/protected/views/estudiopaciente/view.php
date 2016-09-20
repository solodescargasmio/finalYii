<?php
/* @var $this EstudioPacienteController */
/* @var $model EstudioPaciente */

$this->breadcrumbs=array(
	'Estudio Pacientes'=>array('index'),
	$model->id_estudio,
);

$this->menu=array(
	array('label'=>'List EstudioPaciente', 'url'=>array('index')),
	array('label'=>'Create EstudioPaciente', 'url'=>array('create')),
	array('label'=>'Update EstudioPaciente', 'url'=>array('update', 'id'=>$model->id_estudio)),
	array('label'=>'Delete EstudioPaciente', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_estudio),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EstudioPaciente', 'url'=>array('admin')),
);
?>

<h1>View EstudioPaciente #<?php echo $model->id_estudio; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_estudio',
		'id_paciente',
		'fecha_estudio',
		'numero',
	),
)); ?>
