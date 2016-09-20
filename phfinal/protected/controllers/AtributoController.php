<?php

class AtributoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','controlAtributo'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$tablas=Tabla::model()->findAll('id_attributo='.$id);
		//var_dump($tablas);
		$this->render('view',array(
			'model'=>$this->loadModel($id), 'tablas' => $tablas,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Atributo;
		$tabla=new Tabla;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
      // var_dump($model->id_attributo);exit();
		if(isset($_POST['Atributo']))
		{
			 
			$model->attributes=$_POST['Atributo'];
			if($model->save()){
			if($_POST['Tabla']){	
		$atrib = Yii::app()->db->createCommand("SELECT MAX(id_attributo) AS id FROM atributo")->queryRow();
        $id_attributo = $atrib["id"];
        
        $opcion=$_POST['Tabla'];
			 $arreglo=explode(',',$opcion['opcion']);

                for($i=0;$i<count($arreglo);$i++) {
                	$tabla1=new Tabla;
                 $tabla1->id_attributo=$id_attributo;
               $tabla1->isNewRecord = true;
                $tabla1->opcion=$arreglo[$i];	
                $tabla1->save();
                }
            }
				$this->redirect(array('view','id'=>$model->id_attributo));
			}
		}

		$this->render('create',array(
			'model'=>$model, 'tabla' => $tabla,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        //$tabla=Tabla::model()->findAll('id_attributo='.$id);
       // var_dump($tabla);exit();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Atributo']))
		{	
			$model->attributes=$_POST['Atributo'];
			if($model->save()){
				if($_POST['Tabla']){
					$opcion=$_POST['Tabla'];
					if(strcmp($opcion['opcion'],"")!=0){
Yii::app()->db->createCommand("DELETE FROM tabla WHERE id_attributo=".$id)->query();						
					}
						
			 $arreglo=explode(',',$opcion['opcion']);
                for($i=0;$i<count($arreglo);$i++) {
                	$tabla1=new Tabla;
                 $tabla1->id_attributo=$id;
               $tabla1->isNewRecord = true;
                $tabla1->opcion=$arreglo[$i];	
                $tabla1->save();
                } //fin for()
            }	//fin if($_POST['tabla'])
				$this->redirect(array('view','id'=>$model->id_attributo));
			}
		}

		$this->render('update',array(
			'model'=>$model, 
					));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Atributo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Atributo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Atributo']))
			$model->attributes=$_GET['Atributo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionControlAtributo()
	{
		
              $ok=0;
              if($_POST['attr']){
              	$attr=trim($_POST['attr']);
        $admin=Atributo::model()->find('nombre="'.$attr.'"');
       // var_dump($admin);exit();
        if(is_numeric($admin->id_attributo)){
        $ok=$admin->id_attributo;	
        }    
       	echo $ok;
              }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Atributo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Atributo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Atributo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='atributo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
