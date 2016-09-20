<?php
/* @var $this EstudioAtributoController */
/* @var $model EstudioAtributo */

$this->breadcrumbs=array(
	'Estudio Atributos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EstudioAtributo', 'url'=>array('index')),
	array('label'=>'Create EstudioAtributo', 'url'=>array('create')),
	array('label'=>'View EstudioAtributo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EstudioAtributo', 'url'=>array('admin')),
);
?>

<h1>Update EstudioAtributo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>