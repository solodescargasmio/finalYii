<?php 
class Ctrl_dinamicoController extends CController
{
  


	public function actionIndex(){
		$atributo=CActiveRecord::model("Atributo")->findAll();
		$hola="Esta es una prueba para el navegador ñ * · #";
		$this->render("index",array('hola' => $hola, 'atributo' => $atributo));
	}


	public function actionRecibeform(){
    require_once('crearMKdir.php');
    require_once('guardarMultimedia.php');

	$id_estudio=Yii::app()->getsession()->get('id_estudio');

	$id_paciente=Yii::app()->getsession()->get('id_paciente');

	$num=0;

	if (empty($id_estudio)) { //si no hay en session un id_estudio

		$id_estudio=0; //lo inicializo a cero para que no de errores
		Yii::app()->getSession()->add('id_estudio', $id_estudio); //lo agrego como variable de session
		
	}
/*
/////////////////////////////////////////////////////////////////////////////////////////////////
*/
if($_GET['id_form']){

    		$idv=trim($_GET['id_form']); //trim es para quitar espacios en blanco
    		$nombre=trim($_GET['nombre']);
    		
   	$criter=new CDbCriteria;
 	$criter->select='*';
 	$criter->compare('nombre',$nombre);
 	$criter->compare('activo',"1");
 	$formu=new Form;
 	$formu->isNewRecord = true;
 	$formu=Form::model()->find($criter);
 	$formu->activo=0;
 	$formu->save();
 		$criteri=new CDbCriteria;
 	$criteri->select='*';
 	$criteri->compare('id_form',$idv);
 	$formul=new Form;
 	$formul->isNewRecord = true;
 	$formul=Form::model()->find($criteri);
 	$formul->activo=1;
 	$formul->save();
 	$this->render("formularios",array('nom_form' => $nombre, 'id_paciente' => $id_paciente));
    	}
/*
/////////////////////////////////////////////////////////////////////////////////////////////////
*/

	if(isset($_GET['dato'])){ //por get recibo el nombre del formulario	
			$dato=$_GET['dato'];
 $this->render("formularios",array('nom_form' => $dato, 'id_paciente' => $id_paciente));
		}
		if(isset($_POST)){ //por post recibo todos los datos que llenaron del form
			$arreglo=$_POST;
			$estudi=new EstudioPaciente;
			$si=false;
            $ok=false;
			/*
        Yii::app()->clientScript->registerScript('miscript', "
    $('#guardar').click(function(){
 $('#todo').hide();
");
			*/
			foreach ($arreglo as $key => $value) {
               if(strcmp($value,"paciente")==0){ //si el form es paciente creo el estudio
               $si=true;
               } 
               if($si){ //si el form es paciente
               	   if(strcmp($key,"id_paciente")==0){ //si el campo es id_paciente empiezo a guardar el estudio
               	 	$est=EstudioPaciente::model()->count('id_paciente='.$value);
               	 	Yii::app()->getSession()->add('id_paciente', $value);
               	 	crearDir($value);
					$num=$est + 1; //esto es para contar la cantidad de estudios que tiene ese paciente
               	    $estudi->id_paciente=$value;
               	    }
                  $fechaes=date('Y-m-d');//creo la fecha actual del estudio para registrar
                  $estudi->fecha_estudio=$fechaes;
                 if($num==0){
                 	$num=1;
                 }
                 $estudi->numero=$num;//numero de estudio por si hay mas de uno para un paciente
              	     
                  if($estudi->save()) { //si guardo estudio_paciente en bd
              //a continuacion obtengo el id del estudio_paciente que acabo de ingresar.    	
                  	$estudiopa = Yii::app()->db->createCommand("SELECT MAX(id_estudio) AS id FROM estudio_paciente")->queryRow();
$idestudio = $estudiopa["id"];
             Yii::app()->getSession()->add('id_estudio', $idestudio); //lo guardo en la variable de session
                  }
                 } //fin if $si

			}//fin del for
         
        $id_estudio=Yii::app()->getsession()->get('id_estudio');
        
        
        $cont=0;
			foreach ($arreglo as $key => $value) { //este for es para llenar el estudio_atributo
		$estatr=new EstudioAtributo;
		$estatr->isNewRecord = true; //Esto es importante, indica que es un nuevo modelo, sino guarda solo el ultimo.
		 if(strcmp($key,"nomformulario")==0){
		 		$estudiopa = Yii::app()->db->createCommand("SELECT id_form FROM form WHERE nombre='".$value."' AND activo=1")->queryRow();
$idform = $estudiopa["id_form"];
                 
                 } 
                
               $estudiop = Yii::app()->db->createCommand("SELECT id_attributo FROM atributo WHERE nombre='".$key."'")->queryRow();
$id_attributo = $estudiop["id_attributo"];

         if(!is_null($id_attributo)){
   $arrayName = array('id_estudio' => $id_estudio,'id_form' => $idform,'id_attributo' => $id_attributo,'valor' => $value);
               $estatr->attributes=$arrayName;
               }
          if($estatr->save()){
          	$ok=true;
          }

		}//fin for

if($_FILES){
				$ok=subirDatos($idform);		
			}

		   if($ok){ ?>

<script type="text/javascript">
       window.location= 'index';
        </script>
<?php
				}	
	
	}// fin if($_POST)
	
 }

	public function actionAjaxControlarAjax(){

	$user=$_POST['user'];
	$usuario=EstudioPaciente::model()->findAllByAttributes(array('id_paciente' => $user));
     $con=count($usuario);
    if ($con==0) {
      echo '<img src="./images/si.png" title="No existe en BD" alt="No existe en BD" />';
	} else {
	echo '<img src="./images/no.png" title="Ya existe en BD" alt="Ya existe en BD" />Este paciente existe en sistema.';
	}
    
	}

	public function actionModificar($idform){
   require_once('eliminarArchivos.php');
		$id_estudio=Yii::app()->getsession()->get('id_estudio');
		$estudio=EstudioAtributo::model()->findAllByAttributes(array('id_estudio' => $id_estudio, 'id_form'=>$idform));
    $sql="SELECT id_attributo FROM form_attr WHERE id_form=".$idform."";
          $form_att=FormAttr::model()->findAllBySql($sql); //traiga el id de los atributos del form
		//$form_att=FormAttr::model()->findAll('id_form='.$idform));
		$this->render("modificar",array('estudio' => $estudio, 'idform' => $idform, 'form_att' => $form_att));

		if($_POST){

			$arreglo=$_POST;
			foreach ($arreglo as $key => $value) {
        if(strcmp($key,"nomformulario")!=0){
          $attr=Atributo::model()->find("nombre='".$key."'");
        //////////////////////////////////////////////////////////////////
          $estudiop = Yii::app()->db->createCommand("SELECT id FROM estudio_atributo WHERE id_estudio=".$id_estudio." AND id_form=".$idform." AND id_attributo =".$attr->id_attributo)->queryRow();
$id = $estudiop["id"];
      if(!is_null($id)){ //id distinto de null = existe en bd
         Yii::app()->db->createCommand("UPDATE estudio_atributo SET valor = '".$value."' WHERE  id =".$id)->query();
       }else{ //id = null no existe en bd creo un estudio atributo y guardo registro nuevo
  $estudio_atributo=new EstudioAtributo;
        $estudio_atributo->isNewRecord=true;
        $estudio_atributo->id_estudio=$id_estudio;
        $estudio_atributo->id_form=$idform;
        $estudio_atributo->id_attributo=$attr->id_attributo;
        $estudio_atributo->valor=$value;
        $estudio_atributo->save();
       } //fin else id distinto de null

      } //fin if(strcmp($key,"nomformulario")!=0)
        //////////////////////////////////////////////////////////////////
			}//fin foreach ($arreglo as $key => $value)
      if($_FILES){
    eliminarArchivo($idform);    
      }
      ?>

<script type="text/javascript">
       window.location= 'index';
        </script>
<?php
		}
	}

	public function actionMostrarform(){

	$id_estudio=Yii::app()->getsession()->get('id_estudio');
	$id_paciente=Yii::app()->getsession()->get('id_paciente');

	if($_GET['dato']){
          $dato=$_GET['dato'];
          $est = Yii::app()->db->createCommand("SELECT DISTINCT form.id_form FROM form,estudio_atributo WHERE estudio_atributo.id_form=form.id_form AND form.nombre='".$dato."'")->queryRow();
$id_form = $est["id_form"]; 
$criteria=new CDbCriteria;
$criteria->select='*'; 
$criteria->compare('id_estudio',$id_estudio);
$criteria->compare('id_form',$id_form);
if(!is_null($id_form)){
        $estudio_atributo=EstudioAtributo::model()->findAll($criteria);
       $this->render("mostrarform",array('estudio_atributo' => $estudio_atributo,'nom_form'=>$dato));
	   }else{
 $this->render("formularios",array('nom_form' => $dato, 'id_paciente' => $id_paciente));	   	
	    }
	   }
	  }

	
		public function actionDescargar(){
			require_once("claves.php");
	     if($_GET['nom_archivo']){
	     	$dato=$_GET['nom_archivo'];
$id_paciente=Yii::app()->getsession()->get('id_paciente');
    $id_estudio=Yii::app()->getsession()->get('id_estudio');
     $estudio=EstudioPaciente::model()->find('id_estudio='.$id_estudio);
    $estu=$estudio->numero; //obtengo numero del estudio para crear la carpeta
$enlace = Ruta.$id_paciente."/".$estu."/".$dato; 
header ("Content-Disposition: attachment; filename=".$dato." "); 
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
	       exit;
	     }
	}

	public function actionCrearform(){
		
    if($_POST['nom_formulario']){
    	       $dato=$_POST;
$cant=  count($dato);
$id=0;
$con=0;
$id_form=0;
$va=$_POST['nom_formulario'];
$nombr=trim($va);
      $form=new Form;
      $form->nombre=$nombr;
           $version=1;
        $form->version=$version;
        $fechacre=date('Y-m-d');//creo la fecha actual del estudio para registrar
        $form->fecha_crea=$fechacre;
        $form->activo=1;
    
         if($form->save()) { //si guardo form en bd
              //a continuacion obtengo el id del estudio_paciente que acabo de ingresar.    	
                  	$formid=Yii::app()->db->createCommand("SELECT MAX(id_form) AS id FROM form")->queryRow();
$id_form=$formid["id"];       

foreach ($dato as $key => $value){ //recorro todos los datos que vienen
	     $fo_att=new FormAttr;
         $fo_att->isNewRecord = true; //indica que el modelo es uno nuevo, no es el mismo
         $fo_att->id_form=$id_form; //agrego el id_form
    /////////////////////////////////////////////
 if((strcmp($key, 'nom_formulario')==0)){ } //si es nombre del form no hago nada, ya tengo el id
 else if(strcmp($value,"on")==0){ //si el valor de la variable es numerico
 	$criteria=new CDbCriteria;
 	$criteria->select='*';
 	$criteria->compare('id_form',$id_form);
 	$criteria->compare('id_attributo',$key);
 	$fo_at=new FormAttr;
 	$fo_att->isNewRecord = true;
 	$fo_at=FormAttr::model()->find($criteria);
 	$fo_at->obligatorio=1;
 	$fo_at->save();
//Yii::app()->db->createCommand("UPDATE form_attr SET obligatorio=1 WHERE id_form=".$id_form." AND id_attributo=".$key)->query(); 	
 }
 else{ 
     $atid=Yii::app()->db->createCommand("SELECT id_attributo FROM atributo WHERE nombre='".$key."'")->queryRow();
        $ida=$atid["id_attributo"];
        $fo_att->id_attributo=$ida; 
        $fo_att->obligatorio=0;
        $fo_att->save();
      } 
 
///////////////////////////////////////////////
    }//fin foreach(($dato as $key => $value))
   } //fin if($form->save())
    }
    $this->render('crearform');
	}

	public function actionControlForm()
    { 
       //var_dump();
    	$id_form=0;
    	$sql="SELECT id_form FROM form WHERE nombre='".$_POST['nomformulario']."'";
        $form=Form::model()->findAllBySql($sql); 
       foreach ($form as $key => $value){
       	$id_form=$value->id_form;
       }
       echo $id_form;
      
    }

    public function actionNuevaVersion()
    { 

    //Tenes que ver porque no elimina lo existente al seleccionar otro form
    ///
    ///
    /// 
   if($_POST['nom_formulario']){
    	       $dato=$_POST;
$cant=  count($dato);
$id=0;
$con=0;
$id_form=0;
$va=$_POST['nom_formulario'];
$nombr=trim($va);
      $form=new Form;
      $form->nombre=$nombr;

 	$formver=Yii::app()->db->createCommand("SELECT MAX(version) AS ver FROM form WHERE nombre='".$nombr."'")->queryRow();
$ver=$formver["ver"]; //esto es para obtener el numero mayor de version para sumar uno a la version nueva

$idver=Yii::app()->db->createCommand("SELECT id_form FROM form WHERE nombre='".$nombr."' AND activo=1")->queryRow();
$idv=$idver["id_form"]; //esto es para obtener el id de la version activada para luego desactivarla


        $version=$ver+1; 
        $form->version=$version;
        $fechacre=date('Y-m-d');//creo la fecha actual de la version para registrar
        $form->fecha_crea=$fechacre;
        $form->activo=1;
    
         if($form->save()) { //si guardo form en bd
         //	lo que sigue es para desactivar el form anterior y que quede activada la nueva version 
    $criter=new CDbCriteria;
 	$criter->select='*';
 	$criter->compare('id_form',$idv);
 	$formu=new Form;
 	$formu->isNewRecord = true;
 	$formu=Form::model()->find($criter);
 	$formu->activo=0;
 	$formu->save();

              //a continuacion obtengo el id del form que acabo de ingresar    	
                  	$formid=Yii::app()->db->createCommand("SELECT MAX(id_form) AS id FROM form")->queryRow();
$id_form=$formid["id"];       

foreach ($dato as $key => $value){ //recorro todos los datos que vienen
	     $fo_att=new FormAttr;
         $fo_att->isNewRecord = true; //indica que el modelo es uno nuevo, no es el mismo
         $fo_att->id_form=$id_form; //agrego el id_form
    /////////////////////////////////////////////
 if((strcmp($key, 'nom_formulario')==0)){ } //si es nombre del form no hago nada, ya tengo el id
 else if(strcmp($value,"on")==0){ //si el valor de la variable es numerico
 	$criteria=new CDbCriteria;
 	$criteria->select='*';
 	$criteria->compare('id_form',$id_form);
 	$criteria->compare('id_attributo',$key);
 	$fo_at=new FormAttr;
 	$fo_att->isNewRecord = true;
 	$fo_at=FormAttr::model()->find($criteria);
 	$fo_at->obligatorio=1;
 	$fo_at->save();
//Yii::app()->db->createCommand("UPDATE form_attr SET obligatorio=1 WHERE id_form=".$id_form." AND id_attributo=".$key)->query(); 	
 }
 else{ 
     $atid=Yii::app()->db->createCommand("SELECT id_attributo FROM atributo WHERE nombre='".$key."'")->queryRow();
        $ida=$atid["id_attributo"];
        $fo_att->id_attributo=$ida; 
        $fo_att->obligatorio=0;
        $fo_att->save();
      } 
 
///////////////////////////////////////////////
    }//fin foreach(($dato as $key => $value))
   } //fin if($form->save())
    }
       $this->render('nuevaVersion');  
    }

    public function actionCargarAttversion(){// carga mediante ajax los atributos del form elejido en nueva version
        $dato=trim($_POST['formulario']);
        //obtengo el id_form del form activo con nombre $dato
 $idf=Yii::app()->db->createCommand("SELECT DISTINCT id_form FROM form WHERE nombre='".$dato."' AND activo=1")->queryRow();
        $id_form=$idf["id_form"]; //aca saco el id
       $sql="SELECT id_attributo FROM form_attr WHERE id_form=".$id_form."";
          $resultados=FormAttr::model()->findAllBySql($sql); //traiga el id de los atributos del form
 	foreach ($resultados as $key => $value) {
	$id_att=$value->id_attributo; 
	//obtengo el id y con este dato saco el nombre del atributo
 		$noma=Yii::app()->db->createCommand("SELECT nombre FROM atributo WHERE id_attributo='".$id_att."'")->queryRow();
        $nombre=$noma["nombre"];
        //con esos datos lleno lo de abajo para que se muestre en nueva version
 	echo '<div class="form-group" id="'.$nombre.'" style="border-width: 10px; background:#C8C0C0; width:40%;">';
    echo '<label  class="col-sm-8 control-label">'.strtoupper($nombre).'</label>';
    echo '<div class="col-lg-10">';
    echo '<input type="text" id="'.$nombre.'" name="'.$nombre.'" value="'.$nombre.'" hidden>';
    echo '<input type="text" id="'.$id_att.'" name="'.$id_att.'" value="'.$id_att.'" hidden>';
    echo  '<input type="button" id="'.$nombre.'" value="X" style="color: red;" name="eliminar" ident="'.$nombre.'" onclick="eliminarElementoDom('.$id_att.')">Obligatorio<input type="checkbox" id="'.$id_att.'" name="'.$id_att.'">';
    echo '</div></div><br>';   
 	}  
           echo '<div class="col-lg-10">';
            echo '<input type="submit" value="Guardar Formulario" ident="guardo" id="guardo" class="btn btn-primary btn-group-justified">';
 	echo '</div></div>';       

    }

    public function actionElejirVersion(){

    	$dato=$_GET['dato'];
    	//$dato='vop';
    	$this->render('elejirVersion',array('dato'=>$dato));
    }
 
public function actionCargando(){

    	
    	//$dato='vop';
    	$this->render('cargando');
    }

    public function actionExportar(){
$id_paciente=Yii::app()->getSession()->get('id_paciente');
   if(empty($id_paciente)){
      Yii::app()->clientScript->registerScript('alerta', "
  alert('Seleccionar un paciente para trabajar');
");
       $this->render('index');         
     }else{

      Yii::import('ext.PHPExel.PHPExcel');
         
        $objXLS = new PHPExcel();

  $id_estudio=Yii::app()->getsession()->get('id_estudio');
    $id_paciente=Yii::app()->getsession()->get('id_paciente');
    $estudio=EstudioPaciente::model()->find('id_estudio='.$id_estudio);
      $estu=$estudio->numero; //obtengo numero del estudio para crear la carpeta
      $sqle="SELECT DISTINCT form.nombre, form.id_form FROM form,estudio_atributo WHERE id_estudio=$id_estudio AND estudio_atributo.id_form=form.id_form";
   $estudios=Form::model()->findAllBySql($sqle);
  foreach ($estudios as $key => $value){
  $objSheet = $objXLS->setActiveSheetIndex(0);
    $positionInExcel=0;//esto es para que ponga la nueva pestaña al principio
  $objXLS->createSheet(0);//creamos la pestaña
  $objXLS->getActiveSheet(0)->setTitle(strtoupper($value->nombre));
  $objXLS->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
  $objXLS->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
  $sqle="SELECT * FROM estudio_atributo WHERE id_estudio=$id_estudio AND estudio_atributo.id_form=".$value->id_form;
  $estudio_atributo=EstudioAtributo::model()->findAllBySql($sqle);
  $numero=1;
  foreach ($estudio_atributo as $kes => $estat) {  
       $numero=$numero+1;
  $objSheet->setCellValue('A'.$numero, $estat->id_attributo);
  $objSheet->setCellValue('B'.$numero,$estat->valor);
  }

  }
  header('Content-type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename=EstudioNº".$estu."_".$id_paciente.".xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5');
  $objWriter->save('php://output');
    }
  }


  public function actionNuevoestudio(){
    $mensage="";
    $nombre=Yii::app()->getSession()->get('nombre_usuario');    
  $apellido=Yii::app()->getSession()->get('apellido_usuario');
  $nomcompl=$nombre." ".$apellido;//si es otro usuario el que genera el estudio
  $ok=false;
    $id_estudio=$_GET['dato'];
     $estudio=EstudioPaciente::model()->find('id_estudio='.$id_estudio);
    $estu=$estudio->numero; //obtengo numero del estudio 
    $numero=$estu+1;
    $formid=Yii::app()->db->createCommand("SELECT id_form AS id FROM form WHERE nombre='paciente' AND activo='1'")->queryRow();
$id_form=$formid["id"];

  $criteria=new CDbCriteria;
  $criteria->select='*';
  $criteria->compare('id_estudio',$id_estudio);
  $criteria->compare('id_form',$id_form);
  $estudio_atributo=EstudioAtributo::model()->findAll($criteria);
  $estudi=new EstudioPaciente;

  foreach ($estudio_atributo as $key => $value) {
    $atri=Atributo::model()->find('id_attributo='.$value->id_attributo);
    //hasta aca bieeen
    
     if(strcmp($atri->nombre,"id_paciente")==0){ //si el campo es id_paciente empiezo a guardar el estudio
                    $estudi->id_paciente=$value->valor;
                    }
                  $fechaes=date('Y-m-d');//creo la fecha actual del estudio para registrar
                  $estudi->fecha_estudio=$fechaes;
                
                 $estudi->numero=$numero;//numero de estudio por si hay mas de uno para un paciente
                     
                  if($estudi->save()) { //si guardo estudio_paciente en bd
              //a continuacion obtengo el id del estudio_paciente que acabo de ingresar.      
                    $estudiopa = Yii::app()->db->createCommand("SELECT MAX(id_estudio) AS id FROM estudio_paciente")->queryRow();
$idestudio = $estudiopa["id"];
             Yii::app()->getSession()->add('id_estudio', $idestudio); //lo guardo en la variable de session
                  }}
                  foreach ($estudio_atributo as $key => $value) {
    $atri=Atributo::model()->find('id_attributo='.$value->id_attributo);
    //hasta aca bieeen
    
  $estatr=new EstudioAtributo;
    $estatr->isNewRecord = true; //Esto es importante, indica que es un nuevo modelo, sino guarda solo el ultimo.

        
   $arrayName = array('id_estudio' => $idestudio,'id_form' => $id_form,'id_attributo' => $value->id_attributo,'valor' => $value->valor);
               $estatr->attributes=$arrayName;
               
          if($estatr->save()){
            $ok=true;
          }
    }//fin foreach ($estudio_atributo)
    if($ok){
      $this->render('index');
    }else{
      $mensage="Error al crear el nuevo estudio.";
    }
    }//fin funcion  
    

}
?>