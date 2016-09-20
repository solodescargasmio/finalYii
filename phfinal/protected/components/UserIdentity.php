<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
//traigo el usuario que coincida con el nick
$registro = administrador::model()->findByAttributes(array('nick' => $this->username));
if($registro!=null){//si el usuario existe
	if(strcmp($this->username, $registro->nick)!=0) //si el nick no es el mismo
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(strcmp($this->password, $registro->pass)!=0) //si la pass no es la misma
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else  //si el nick y pass son correctos creo las variables de session
		
	Yii::app()->getSession()->add('id_usuario', $registro->id);
	Yii::app()->getSession()->add('tipo_usuario', $registro->tipo);		
	Yii::app()->getSession()->add('usuario', $registro->nick);
	Yii::app()->getSession()->add('nombre_usuario', $registro->nombre);		
	Yii::app()->getSession()->add('apellido_usuario', $registro->apellido);
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
}else{//si el usuario no existe
	$this->errorCode=self::ERROR_USERNAME_INVALID;
}

	}
}