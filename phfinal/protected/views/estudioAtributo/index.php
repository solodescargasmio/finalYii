<?php
/* @var $this EstudioAtributoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Estudio Atributos',
);

$this->menu=array(
	array('label'=>'Create EstudioAtributo', 'url'=>array('create')),
	array('label'=>'Manage EstudioAtributo', 'url'=>array('admin')),
);
?>

<h1>Estudio Atributos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
