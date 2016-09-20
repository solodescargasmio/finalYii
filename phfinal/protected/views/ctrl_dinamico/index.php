

<?php 

$paciente=Yii::app()->getSession()->get('id_paciente');

  if(!isset($paciente)){
  echo "<h3>";
  echo CHtml::link('Comenzar a trabajar con un paciente',array('/site/admin', 'view'=>'admin')); 
 echo "</h3>"; 
  }else{
  	$id_estudio=Yii::app()->getSession()->get('id_estudio'); 
?> 
<h3>Flujo de ingreso de datos para este paciente : <?php echo $paciente; ?></h3> 
<table class="table" id="table">
<thead>
	<tr>
		<th>Nombre Formulario</th>
		<th>Estado</th>
	</tr>
    </thead>
    <tbody>
<?php 
   $sql="SELECT DISTINCT nombre FROM form";
		 $form=Form::model()->findAllBySql($sql);       
 $sqle="SELECT DISTINCT form.nombre FROM form,estudio_atributo WHERE id_estudio=$id_estudio AND estudio_atributo.id_form=form.id_form";
 $estudio=Form::model()->findAllBySql($sqle); 
     $arreglo=array();
     foreach ($estudio as $keys => $values) {
     	$arreglo[]=$values->nombre;//esto lo hago para saber cual esta con datos 
     }
         foreach ($form as $key => $value) {
         	echo "<tr><th>".ucwords($value->nombre)."</th>"?>
  <th><a href=<?php echo Yii::app()->createUrl('ctrl_dinamico/recibeform', array('dato' => $value->nombre))?>> 
 <?php $indice = array_search($value->nombre,$arreglo,false); 
if(is_numeric($indice)){ //si esta en el arreglo, significa que ya fue llenado ?>
<img src="./images/si.png" title="Completo" />
<?php } else { ?> 
<img src="./images/no.png" title="Vacio" />
<?php }
 ?> 
  </a></th>
         <?php	echo "</tr>";    
         }
?></tbody>
</table>
<?php } ?>