<?php

/**
 * This is the model class for table "estudio_paciente".
 *
 * The followings are the available columns in table 'estudio_paciente':
 * @property integer $id_estudio
 * @property integer $id_paciente
 * @property string $fecha_estudio
 * @property integer $numero
 *
 * The followings are the available model relations:
 * @property EstudioAtributo[] $estudioAtributos
 */
class EstudioPaciente extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'estudio_paciente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_paciente, fecha_estudio, numero', 'required'),
			array('id_paciente, numero', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_estudio, id_paciente, fecha_estudio, numero', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'estudioAtributos' => array(self::HAS_MANY, 'EstudioAtributo', 'id_estudio'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_estudio' => 'Id Estudio',
			'id_paciente' => 'Id Paciente',
			'fecha_estudio' => 'Fecha Estudio',
			'numero' => 'Numero',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_estudio',$this->id_estudio);
		$criteria->compare('id_paciente',$this->id_paciente);
		$criteria->compare('fecha_estudio',$this->fecha_estudio,true);
		$criteria->compare('numero',$this->numero);

		return new CActiveDataProvider($this, array(
			  'pagination'=>array(
                                            'pageSize'=>2, //esto pagina de 2 en 2
                                            ),
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EstudioPaciente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
