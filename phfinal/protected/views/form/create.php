<?php
/* @var $this FormController */
/* @var $model Form */

$this->breadcrumbs=array(
	'Forms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Form', 'url'=>array('index')),
	array('label'=>'Manage Form', 'url'=>array('admin')),
);
?>

<h1>Create Form</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>