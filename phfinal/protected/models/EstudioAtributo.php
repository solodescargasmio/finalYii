<?php

/**
 * This is the model class for table "estudio_atributo".
 *
 * The followings are the available columns in table 'estudio_atributo':
 * @property integer $id
 * @property integer $id_estudio
 * @property integer $id_form
 * @property integer $id_attributo
 * @property string $valor
 *
 * The followings are the available model relations:
 * @property EstudioPaciente $idEstudio
 */
class EstudioAtributo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'estudio_atributo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_estudio, id_form, id_attributo, valor', 'required'),
			array('id_estudio, id_form, id_attributo', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_estudio, id_form, id_attributo, valor', 'safe', 'on'=>'search'),
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
			//'idEstudio' => array(self::BELONGS_TO, 'Attributo', 'id_attributo'),
			'idEstudio' => array(self::BELONGS_TO, 'EstudioPaciente', 'id_estudio'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_estudio' => 'Id Estudio',
			'id_form' => 'Id Form',
			'id_attributo' => 'Id Attributo',
			'valor' => 'Valor',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_estudio',$this->id_estudio);
		$criteria->compare('id_form',$this->id_form);
		$criteria->compare('id_attributo',$this->id_attributo);
		$criteria->compare('valor',$this->valor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EstudioAtributo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
