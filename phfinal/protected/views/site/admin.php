<?php
/* @var $this EstudioPacienteController */
/* @var $model EstudioPaciente */

/*$this->breadcrumbs=array(
	'Estudio Pacientes'=>array('index'),
	'Manage',
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#estudio-paciente-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><font style=color:blue;>Seleccione el paciente con el cual va a trabajar</font></h3>

<p>
Las cajas de texto, debajo de los nombres de los campos, sirven para filtrar los resultados.<br>
Ingrese el valor por el cual va a realizar la búsqueda (Acepta busquedas <,>,>=,<=).<br> Búsqueda Avanzada muestra un formulario para relizar búsqueda.
</p>

<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'estudio-paciente-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	
	'columns'=>array(
		array(
          'name'=>'id_estudio',
          'visible'=>false,
            ),
		'id_paciente',
		'fecha_estudio',
		'numero',
	 array(  // muestra una columna con los botones "view", "update" y "delete"
           'class' => 'CButtonColumn',
          'template'=>'{Trabajar}',
    'buttons'=>array
    (
        'Trabajar' => array
        (
            'label'=>'Trabajar con este paciente',
            'imageUrl'=>Yii::app()->request->baseUrl.'/images/trabajar 1.png',// 'url'=>'Yii::app()->createUrl("/nombre_modelo/accion_nueva?id=$data->id" )', //url de la acción nueva
		    'url'=>'Yii::app()->createUrl("site/Session", array("id_estudio"=>$data->id_estudio, "cedula" => $data->id_paciente))',
		    ),

        ),
    ),
))); ?>
