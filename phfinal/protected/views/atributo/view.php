<?php
/* @var $this AtributoController */
/* @var $model Atributo */

$this->breadcrumbs=array(
	'Atributos'=>array('index'),
	$model->id_attributo,
);
$this->menu=array(
	array('label'=>'Listar Atributo', 'url'=>array('index')),
	array('label'=>'Crear Atributo', 'url'=>array('create')),
	array('label'=>'Actualizar Atributo', 'url'=>array('update', 'id'=>$model->id_attributo)),
	array('label'=>'Administrar Atributo', 'url'=>array('admin')),
);
?>

<h1>Ver Atributo #<?php echo $model->id_attributo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_attributo',
		'nombre',
		'tipo',
		 'tabla',
	),
)); 

$tab=new Tabla;
// para obtener las opciones si es compuesto
    $tabla=Tabla::model()->findAll("id_attributo=".$model->id_attributo);

   $total=count($tabla);
if(!is_null($tabla)){ 
            $arreglo="";
			$con=0;
      foreach ($tabla as $key => $value) {
      $con=$con+1;
      	$arreglo.=$value->opcion;
      	if($con<$total){
      		$arreglo.=",";
      	}
      }
      $tab->opcion=$arreglo;
     $this->widget('zii.widgets.CDetailView', array(
	'data'=>$tab,
	'attributes'=>array(
		'opcion',
	),
));  
 } ?>

