<?php
/* @var $this FormAttrController */
/* @var $model FormAttr */

$this->breadcrumbs=array(
	'Form Attrs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FormAttr', 'url'=>array('index')),
	array('label'=>'Create FormAttr', 'url'=>array('create')),
	array('label'=>'Update FormAttr', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FormAttr', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FormAttr', 'url'=>array('admin')),
);
?>

<h1>View FormAttr #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_form',
		'id_attributo',
		'obligatorio',
	),
)); ?>
