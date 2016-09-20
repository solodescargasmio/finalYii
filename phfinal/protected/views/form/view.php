<?php
/* @var $this FormController */
/* @var $model Form */
$this->breadcrumbs=array(
	'Forms'=>array('index'),
	$model->id_form,
);

$this->menu=array(
	array('label'=>'Listar Formularios', 'url'=>array('index')),
	array('label'=>'Crear Formulario', 'url'=>array('ctrl_dinamico/crearform')),
	array('label'=>'Administrar Formulario', 'url'=>array('admin')),
);
?>

<h1>View Form #<?php echo $model->id_form; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_form',
		'nombre',
		'version',
		'fecha_crea',
	),
)); ?>
