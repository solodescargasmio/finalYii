<?php
/* @var $this FormAttrController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Form Attrs',
);

$this->menu=array(
	array('label'=>'Create FormAttr', 'url'=>array('create')),
	array('label'=>'Manage FormAttr', 'url'=>array('admin')),
);
?>

<h1>Form Attrs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
