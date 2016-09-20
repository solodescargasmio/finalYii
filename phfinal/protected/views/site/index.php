
<script type="text/javascript">
   /* function fondo() {
        var color = $('body').css( 'background-color');
        if (color=='rgb(0, 0, 125)')
                         $('body').css( 'background-color','rgb(125, 0, 0)' );
                else
                         $('body').css( 'background-color','rgb(0, 0, 125)' );
    }
     setInterval("fondo()",1000);*/
</script>
<style>
  #menus{
    cursor:pointer;
  }
</style>
<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<!--<h1>Bienvenido <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>-->

<?php
if(isset($_GET['mensage'])){
  echo $_GET['mensage'];
}
//$this->redirect('admin',array('/EstudioPaciente/admin', 'view'=>'admin')); // Directamente le pasas la instancia.
$paciente=Yii::app()->getSession()->get('id_paciente');
$usuario=Yii::app()->getSession()->get('usuario');
//var_dump($paciente);exit();
if ($usuario) {
  if(!isset($paciente)){
   echo "<h3>";
echo CHtml::link('Comenzar a trabajar con un paciente',array('/site/admin', 'view'=> 'admin')); 
 echo "</h3>"; 
  echo "<br><br><h3>";
  echo CHtml::link('Ingresar paciente nuevo',array('/ctrl_dinamico/recibeform', 'dato'=>'paciente')); 
 echo "</h3>"; 
}else{
  $id_estudio=Yii::app()->getSession()->get('id_estudio'); ?>
  <h3>Flujo de ingreso de datos para este paciente :<?php echo $paciente;
    echo CHtml::link('   Nuevo Estudio',array('/ctrl_dinamico/nuevoestudio', 'dato'=>$id_estudio),array('confirm' => 'Esto creará un nuevo estudio para este paciente. Desea continuar con la operación?'));?>
  </h3>
<table class="table" id="table" style="width:60%;">
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
  <th> 
 <?php $indice = array_search($value->nombre,$arreglo,false); 
if(is_numeric($indice)){ //si esta en el arreglo, significa que ya fue llenado ?>
<a href=<?php echo Yii::app()->createUrl('ctrl_dinamico/mostrarform', array('dato' => $value->nombre))?>>
<img src="./images/si.png" title="Completo <?php echo ucwords($value->nombre); ?>" />
<?php } else { ?> 
<a href=<?php echo Yii::app()->createUrl('ctrl_dinamico/recibeform', array('dato' => $value->nombre))?>>
<img src="./images/no.png" title="Vacio <?php echo ucwords($value->nombre); ?>" />
<?php }
 ?> 
  </a></th>
         <?php  echo "</tr>";    
         }
?></tbody>
</table>
<div id="menus">
  <?php echo CHtml::link('Atributos Completos :','',array('onclick'=>'$("#mymodalA").dialog("open"); return false;')); ?>
</div>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
           'id'=>'mymodalA',
           'options'=>array(
           'autoOpen'=>false,
           'width' => '100%',
  ),
 
  ));
?> 

<?php 
echo $this->renderPartial('atributoCompleto');
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

 <?php }
}

 ?>


<script language="JavaScript">
//Ajusta el tamaño de un iframe al de su contenido interior para evitar scroll
function autofitIframe(id){
if (!window.opera && document.all && document.getElementById){
id.style.height=id.contentWindow.document.body.scrollHeight;
} else if(document.getElementById) {
id.style.height=id.contentDocument.body.scrollHeight+"px";
}
}
</script>