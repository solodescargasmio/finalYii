<?php
/* @var $this EstudioAtributoController */
/* @var $model EstudioAtributo */

$this->breadcrumbs=array(
	'Estudio Atributos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EstudioAtributo', 'url'=>array('index')),
	array('label'=>'Create EstudioAtributo', 'url'=>array('create')),
	array('label'=>'Update EstudioAtributo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EstudioAtributo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EstudioAtributo', 'url'=>array('admin')),
);
?>

<h1>View EstudioAtributo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_estudio',
		'id_form',
		'id_attributo',
		'valor',
	),
)); ?>
