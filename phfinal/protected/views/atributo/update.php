<?php
/* @var $this AtributoController */
/* @var $model Atributo */

$this->breadcrumbs=array(
	'Atributos'=>array('index'),
	$model->id_attributo=>array('view','id'=>$model->id_attributo),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Atributo', 'url'=>array('index')),
	array('label'=>'Crear Atributo', 'url'=>array('create')),
	array('label'=>'Ver Atributo', 'url'=>array('view', 'id'=>$model->id_attributo)),
	array('label'=>'Administrar Atributo', 'url'=>array('admin')),
);

?>

<h1>Update Atributo <?php echo $model->id_attributo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>