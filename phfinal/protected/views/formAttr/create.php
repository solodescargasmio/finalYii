<?php
/* @var $this FormAttrController */
/* @var $model FormAttr */

$this->breadcrumbs=array(
	'Form Attrs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FormAttr', 'url'=>array('index')),
	array('label'=>'Manage FormAttr', 'url'=>array('admin')),
);
?>

<h1>Create FormAttr</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>