<?php
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}


	public function accessRules()
	{
//array('nombre, apellido, ciudad, tratamiento', 'safe', 'on'=>'search'),

		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
'actions'=>array('index','view','create','update','datos',
	'admin','delete','session','restablecerPass',
	'datos','atributoCompleto','cambiarpaciente'),
				'users'=>array('*'),
			),
	
		);
	}


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */

	public function actionIndex()
	{ 
		
        $paciente=Yii::app()->getSession('paciente');
        //var_dump($paciente);exit();
		/*if(isset($paciente)){
		$this->redirect('index?r=EstudioPaciente/admin');}*/
	$dataProvider=new CActiveDataProvider('EstudioPaciente', array(
    'pagination'=>array(
        'pageSize'=>10,
    ),
));
		//$estudio=new EstudioPaciente;
		//$estudio=EstudioPaciente::model()->findAll();
		$this->render('index', array('$dataProvider'=>$dataProvider));
	}

public function actionSession($id_estudio,$cedula)
	{
		//var_dump($cedula);exit();
		Yii::app()->getSession()->add('id_estudio', $id_estudio); 
		Yii::app()->getSession()->add('id_paciente', $cedula);
$this->redirect('index');	
	}

	public function actionCambiarpaciente(){
			if($_GET['cerrar']){
     $id_estudio=null;
			$cedula=null;
		Yii::app()->getSession()->add('id_estudio', $id_estudio); 
		Yii::app()->getSession()->add('id_paciente', $cedula);
		$this->render('index');
		}
	}



	public function actionControlLogin(){
		//var_dump("control");exit();
              $ok=0;
              if($_POST['user']){
              	$usuario=$_POST['user'];
        $admin=administrador::model()->find('nick="'.$usuario.'"');
       // var_dump($admin);exit();
        if(is_numeric($admin->id)){
        $ok=$admin->id;	
        }    
       	echo $ok;
              }   		
	}

public function actionAtributoCompleto(){
      $this->render('atributoCompleto');
    }

public function actionDatos(){
      
$this->render('datos');
    }
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}


	public function actionAdmin()
	{
		$model=new EstudioPaciente('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EstudioPaciente']))
			$model->attributes=$_GET['EstudioPaciente'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    public function actionRestablecerPass(){
		$mensage="";
			if($_POST['nick']){
				$nick=$_POST['nick'];
$persona2=Yii::app()->db->createCommand("SELECT email, nombre, apellido FROM administrador WHERE nick ='".$nick."'")->queryRow();
$email=$persona2["email"];
$nombreCompleto=$persona2["nombre"]." ".$persona2["apellido"];
             $d=mt_rand(1,123456);//creo un numero randomico
                    $pass=$d.$nick;//agrego ese numero al nick
                    $usr=sha1($pass);//encripto la contraseña
                    
Yii::app()->db->createCommand("UPDATE administrador SET pass = '".$usr."' WHERE nick ='".$nick."'")->query();     
                   
                    $cuerpo="Su nueva password es : ".$pass."<br>Ingrese "
                            . "<a href='http://localhost/yii/phfinal/site/login'>aqui</a> con su usuario y la nueva password y luego modifique su password por una mas segura,"
                            . "<br>Gracias";
                     $asunto="Cambio de password";
                       //var_dump($asunto);exit();
                  require_once('claves.php');
       Yii::import('ext.mailer.EMailer');

      
      $mailer=Yii::createComponent( 'application.extensions.mailer.EMailer');
      $mail->CharSet = "UTF-8";
      $mailer->IsSMTP();

     $mailer->IsHTML(true);
     $mailer->SMTPAuth = true;
     $mailer->SMTPSecure = "ssl";
     $mailer->Host = Email_HOST;
     $mailer->Port = 465;
     $mailer->Username = Email;
     $mailer->Password = Epass;
     $mailer->From = Email;
     $mailer->FromName = 'Sistema de gestion de Estudios Medicos Heterogeneos';
     $mailer->AddAddress($email,$nombreCompleto);
     $mailer->Subject = $asunto;
     $mailer->Body = $cuerpo;
     
     if($mailer->Send()){
         $mensage="Se envió un email con la nueva password a su correo registrado.";
     }else{
$mensage="Surgio un error al enviar la nueva password. Verifique.";
}
} //fin if($_POST['nick'])

		
		$this->render('restablecerPass',array('mensage'=>$mensage));
	}

}