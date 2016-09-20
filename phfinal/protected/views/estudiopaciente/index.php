<?php
/* @var $this EstudioPacienteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Estudio Pacientes',
);

$this->menu=array(
	array('label'=>'Create EstudioPaciente', 'url'=>array('create')),
	array('label'=>'Manage EstudioPaciente', 'url'=>array('admin')),
);
?>

<h1>Estudio Pacientes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
