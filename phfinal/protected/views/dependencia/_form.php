<?php
/* @var $this DependenciaController */
/* @var $model Dependencia */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScript('search', '
$("#limpiar").click(function(){
	document.getElementById("Dependencia_de").value="";
    document.getElementById("Dependencia_depende").value="";
});
$(function(){
    $(".version1").click( function(){
            var $dato1=$.trim($(".formular",this).val()); //obtengo el nombre del formulario
            
          var uno=document.getElementById("Dependencia_de").value;
         var dos=document.getElementById("Dependencia_depende").value;  
        if(dos==""){
         document.getElementById("Dependencia_depende").value=$dato1;	
        }else if(uno==""){
        	if(dos!=$dato1){
        		document.getElementById("Dependencia_de").value=$dato1
        	}else{
        		alert("La dependencia ya contiene ese formulario");
        		document.getElementById("Dependencia_de").value="";	
        	}
      	
        } 

    });
    });
	');
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dependencia-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'depende : el siguiente formulario'); ?>
		<?php echo $form->textField($model,'depende',array('readonly'=>'readonly','size'=>20,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'depende'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'de : para llenar el anterior el siguiente debe estar completo'); ?>
		<?php echo $form->textField($model,'de',array('readonly'=>'readonly', 'size'=>20,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'de'); ?>
	</div>

	<div class="row buttons">                                                     
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Save') ?>
	</div>

<?php $this->endWidget();
/*
, onclick="return control();"
*/
 ?>

</div><!-- form -->
           <div class="menu">  <div class="row buttons">                                                     
		<input type="submit" value="Limpiar Cajas" id="limpiar">
	</div>  
    <form id="formversion" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
           <br> <table class="table-responsive" border="1">  
             <font style="font-weight: bold;">   <tr>
                  <td><font style="font-weight: bold;">Formularios en sistema:</font></td>
               </tr>
               <?php

               $sql="SELECT DISTINCT nombre FROM form";
          $resultados=Form::model()->findAllBySql($sql); 
          if($resultados!=null){
          foreach ($resultados as $key => $formulario) {?>
       <tr class="version1">
    <td class="formu">
    <a style="cursor:pointer;">   <input type="text" id="formular" name="formular" class="formular" value=" <?php echo $formulario->nombre; ?>" hidden="">
       
    <font style="font-weight: bold; color: red;"><?php echo strtoupper($formulario->nombre); ?>
    </font>
    </a></td>
    </td>                 
                   </tr>
          <?php   
          } //fin foreach($resultados as $key => $formulario)
          } //fin if($resultados!=null) ?>

           </table> </font>
           </form>    
                </div> 