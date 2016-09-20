<?php
/* @var $this AdministradorController */
/* @var $model administrador */

$this->breadcrumbs=array(
	'Administradors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Usuarios', 'url'=>array('index')),
	array('label'=>'Crear Usuario', 'url'=>array('create')),
	array('label'=>'Borrar Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Seguro desea eliminar este usuario?')),
	array('label'=>'Administrar Usuarios', 'url'=>array('admin')),
);
?>

<h1>Ver Usuario #<?php echo $model->id; ?></h1>
<?php

if($model->tipo==0){$model->tipo="Administrador";}else{
	$model->tipo="Usuario Común";
}

?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nick',
		'nombre',
		'apellido',
		'email',
		'tipo',
	),
)); ?>
