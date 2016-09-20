<?php
/* @var $this FormAttrController */
/* @var $model FormAttr */

$this->breadcrumbs=array(
	'Form Attrs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FormAttr', 'url'=>array('index')),
	array('label'=>'Create FormAttr', 'url'=>array('create')),
	array('label'=>'View FormAttr', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FormAttr', 'url'=>array('admin')),
);
?>

<h1>Update FormAttr <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>