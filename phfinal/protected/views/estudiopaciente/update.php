<?php
/* @var $this EstudioPacienteController */
/* @var $model EstudioPaciente */

$this->breadcrumbs=array(
	'Estudio Pacientes'=>array('index'),
	$model->id_estudio=>array('view','id'=>$model->id_estudio),
	'Update',
);

$this->menu=array(
	array('label'=>'List EstudioPaciente', 'url'=>array('index')),
	array('label'=>'Create EstudioPaciente', 'url'=>array('create')),
	array('label'=>'View EstudioPaciente', 'url'=>array('view', 'id'=>$model->id_estudio)),
	array('label'=>'Manage EstudioPaciente', 'url'=>array('admin')),
);
?>

<h1>Update EstudioPaciente <?php echo $model->id_estudio; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>