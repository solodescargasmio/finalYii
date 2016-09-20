<script type="text/javascript" src="../js/sha1.js"></script>
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/sha1.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript('control', '
	$(document).ready(function(){

		$("#LoginForm_password").on("blur",function(){
			
			var sha=document.getElementById("LoginForm_password").value;
			if(sha!=""){
			var pass=sha1(sha);
			
 document.getElementById("LoginForm_password").value=pass;	
			}
 
		});
$("form").bind("keypress", function(e) {
  if (e.keyCode == 13) {               
    e.preventDefault();
    return false;
  }
});

	$("#LoginForm_username").on("blur",function(){
		var user=document.getElementById("LoginForm_username").value;
		datatypo="user="+user;
		$.ajax({
         url: "index.php?r=site/controlLogin",//llamo a la pagina q hace el control
         type:"POST",//metodo por el cual paso el dato
         data:datatypo,
             success: function (data) { //funcion q recoge la respuesta de la pagina q hace el control
                 // $("#avizo").fadeIn(1000).html(data); //imprimo el mensaje en el div   
                
                 if((data==0)){  
                 alert("El usuario no existe en sistema");	
                 document.getElementById("LoginForm_username").value="";  }

               
    }
     }); 
	}); 
	});
');
?>

<h1>Login</h1>

<p>Por favor, rellene el siguiente formulario con sus datos de acceso:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Login',array('id' => 'login')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
