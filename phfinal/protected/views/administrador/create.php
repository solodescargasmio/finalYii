<?php
/* @var $this AdministradorController */
/* @var $model administrador */

$this->breadcrumbs=array(
	'Administradors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Usuarios', 'url'=>array('index')),
	array('label'=>'Administrar Usuarios', 'url'=>array('admin')),
);
?>

<h1>Crear Usuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>