<?php
/* @var $this EstudioAtributoController */
/* @var $model EstudioAtributo */

$this->breadcrumbs=array(
	'Estudio Atributos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EstudioAtributo', 'url'=>array('index')),
	array('label'=>'Manage EstudioAtributo', 'url'=>array('admin')),
);
?>

<h1>Create EstudioAtributo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>