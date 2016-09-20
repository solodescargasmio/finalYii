<?php
/* @var $this FormController */
/* @var $model Form */
$this->breadcrumbs=array(
	'Forms'=>array('index'),
	$model->id_form=>array('view','id'=>$model->id_form),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Formularios', 'url'=>array('index')),
	array('label'=>'Crear Formulario', 'url'=>array('ctrl_dinamico/crearform')),
	array('label'=>'Administrar Formulario', 'url'=>array('admin')),
);
?>

<h1>Actualizar Nombre Formulario <?php echo $model->nombre; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>