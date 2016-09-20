<?php
/* @var $this DependenciaController */
/* @var $model Dependencia */

$this->breadcrumbs=array(
	'Dependencias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Dependencia', 'url'=>array('index')),
	array('label'=>'Administrar Dependencia', 'url'=>array('admin')),
);
?>

<h1>Crear Dependencia</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>