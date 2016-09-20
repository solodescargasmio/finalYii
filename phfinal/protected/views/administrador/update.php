
<?php
/* @var $this AdministradorController */
/* @var $model administrador */

$this->breadcrumbs=array(
	'Administradors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Actualizar mis datos </h1>

<?php $this->renderPartial('_form', array('model'=>$model,'update'=>'1')); ?>