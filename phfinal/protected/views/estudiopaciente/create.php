<?php
/* @var $this EstudioPacienteController */
/* @var $model EstudioPaciente */

$this->breadcrumbs=array(
	'Estudio Pacientes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EstudioPaciente', 'url'=>array('index')),
	array('label'=>'Manage EstudioPaciente', 'url'=>array('admin')),
);
?>

<h1>Create EstudioPaciente</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>