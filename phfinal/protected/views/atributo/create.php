<?php
/* @var $this AtributoController */
/* @var $model Atributo */

$this->breadcrumbs=array(
	'Atributos'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'Listar Atributo', 'url'=>array('index')),
	array('label'=>'Administrar Atributo', 'url'=>array('admin')),
);
?>

<h1>Create Atributo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>