<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
 
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?> </div>
  <div id="cuadro">
  <?php 
$paciente=Yii::app()->getSession()->get('id_paciente');
$usuario=Yii::app()->getSession()->get('usuario');
$tipo=Yii::app()->getSession()->get('tipo_usuario'); 
$nomusuario=Yii::app()->getSession()->get('nombre_usuario');
$apellido=Yii::app()->getSession()->get('apellido_usuario');
$id_paciente=Yii::app()->getSession()->get('id_paciente');
$arreglo="";
   if(!empty($id_paciente)){
                  $arreglo=array('label'=>'Cambiar Paciente', 'url'=>array('/site/cambiarpaciente','cerrar'=>'cerrar'));
                  }
echo "<font style=' font: oblique bold 120% cursive;'> ".ucwords($nomusuario)."  ".ucwords($apellido)."</font><br>";

?>
   </div> 
		

 
	</div><!-- header -->

	<div id="mainmenu">
    
     
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				$arreglo,
	  array('label'=>'Inicio', 'url'=>array('/site/index')),
                array('label'=>'Manual de Usuario','url'=>array('/site/datos')),
                array('label'=>'Login (anonimo)', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->getSession()->get('usuario').')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)),  
                
		)); ?>
	</div><!-- mainmenu -->

<div id="mbmenu">

    <?php
$usuario=Yii::app()->getSession()->get('usuario');
$tipo_usuario=Yii::app()->getSession()->get('tipo_usuario');

	$idu = Yii::app()->db->createCommand("SELECT id FROM administrador WHERE nick='".$usuario."'")->queryRow();
$id_usuario = $idu["id"];
Yii::app()->getSession()->add('id_usuario', $id_usuario);

if ($usuario) {
           if(strcmp($tipo_usuario,"0")==0){
                 $this->widget('application.extensions.mbmenu.MbMenu',array(
               
            'items'=>array(
              array('label'=>'Llenar Formulario', 'url'=>array('/ctrl_dinamico/index')), 
                array('label'=>'Manejar Usuarios', 'url'=>array('/administrador/admin')),
     array('label'=>'Modificar mi Perfil', 'url'=>array('/administrador/update', 'id'=>$id_usuario)),
               
                  array(

                        'label'=>'Administrar',

                        'items'=>array(
                          array('label'=>'Administrar Atributos',
                           'items'=>array(
                                          array('label'=>'Crear Atributo', 'url'=>array('atributo/create')), 
                                          array('label'=>'Administrar Atributo', 'url'=>array('atributo/admin')),                       
                                          ),),

                          array('label'=>'Administrar Formularios', 'items'=>array(
                                         array('label'=>'Crear Formulario', 'url'=>array('ctrl_dinamico/crearform')),
                                         array('label'=>'Nueva Version', 'url'=>array('ctrl_dinamico/nuevaversion')),
                                         array('label'=>'Modificar Nombre', 'url'=>array('form/admin')),
                                          ),),
                          array('label'=>'Administrar Dependencias', 
                            'items'=>array(
                                         array('label'=>'Crear Dependencias', 'url'=>array('dependencia/create')),
                                         array('label'=>'Administrar Dependencias', 'url'=>array('dependencia/admin')),
                                          ),),

                     ),  

                    ),
array('label'=>'Exportar hojas de  calculo', 'url'=>array('/ctrl_dinamico/exportar')),

                )

        )); 
           } else {// fin if(strcmp($tipo_usuario,"0")==0)
            $this->widget('application.extensions.mbmenu.MbMenu',array(
               
            'items'=>array(
              array('label'=>'Llenar Formulario', 'url'=>array('/ctrl_dinamico/index')), 
               
     array('label'=>'Modificar mi Perfil', 'url'=>array('/administrador/update', 'id'=>$id_usuario)),
     
array('label'=>'Exportar hojas de  calculo', 'url'=>array('/ctrl_dinamico/exportar')),

                )

        ));
                 }  
 }//  fin if ($usuario)

    ?>

</div>



	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
	  <font style="font-family: Times New Roman; size: 6; color: #000;">  <p><a href="http://www.fing.edu.uy/tecnoinf/paysandu/" target="_blank">TIP</a>
           <br><a href="http://www.universidad.edu.uy/" target="_blank"> UdelaR - </a><a href="http://www.utu.edu.uy/utu/inicio.html">CETP-UTU
           <br>
    2016</a></p></font>
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
