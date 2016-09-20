<table class="table" id="table" style="width:80%;">
<thead>
  <tr>
  <th>Formulario</th>
    <th>Atributo</th>
    <th>Valor</th>
  </tr>
    </thead>
    <tbody>
<?php
$id_estudio=Yii::app()->getSession()->get('id_estudio');
$sql="SELECT atributo.nombre,form.id_form,estudio_atributo.valor FROM form,atributo,estudio_paciente,estudio_atributo WHERE estudio_atributo.id_attributo=atributo.id_attributo AND form.id_form=estudio_atributo.id_form AND estudio_paciente.id_estudio=estudio_atributo.id_estudio AND estudio_paciente.id_estudio='".$id_estudio."'";
/*$arreglo=Yii::app()->db->createCommand()->select('atributo.nombre, estudio_atributo.valor')->from('atributo,estudio_paciente,estudio_atributo')
                ->where('estudio_atributo.id_attributo=atributo.id_attributo',array('estudio_paciente.id_estudio=estudio_atributo.id_estudio',':estudio_paciente.id_estudio'=>$id_estudio))->queryAll();
*/
$est=Yii::app()->db->createCommand($sql)->queryAll();

foreach ($est as $key => $value) {
  $id=$value["id_form"];
  $form=Form::model()->find('id_form='.$id);
	echo "<tr>";
  echo "<th>".ucwords($form->nombre)."</th>";
	echo "<th>".ucwords($value["nombre"])."</th>";
	echo "<th>".$value["valor"]."</th>";
    echo "</tr>";
}

 ?>
 </tbody>
 </table>