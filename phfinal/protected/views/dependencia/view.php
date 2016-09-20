<?php
/* @var $this DependenciaController */
/* @var $model Dependencia */

$this->breadcrumbs=array(
	'Dependencias'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Dependencia', 'url'=>array('index')),
	array('label'=>'Crear Dependencia', 'url'=>array('create')),
	array('label'=>'Borrar Dependencia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Seguro desea eliminar esta dependencia? Este cambio es irrebersible.')),
	array('label'=>'Administrar Dependencia', 'url'=>array('admin')),
);
?>

<h1>Ver Dependencia #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'depende',
		'de',
	),
)); ?>
