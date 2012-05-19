<?php

/**
 * This is the model class for table "{{law}}".
 *
 * The followings are the available columns in table '{{law}}':
 * @property integer $id
 * @property string $description
 * @property integer $law_type_id
 * @property integer $chil_id
 */
class Law extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Law the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{law}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('law_type_id, chil_id', 'numerical', 'integerOnly' => true),
            array('description,stop', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, description, law_type_id, chil_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'lawtype' => array(self::BELONGS_TO, 'LawType', 'law_type_id'),
            'chil' => array(self::BELONGS_TO, 'Law', 'chil_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'description' => 'Description',
            'stop' => 'Stop',
            'law_type_id' => 'Law Type',
            'chil_id' => 'Chil',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('chil_id', $this->chil_id);
        if ($this->law_type_id)
            $criteria->compare('law_type_id', $this->law_type_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['pageSize'],
                    ),
                ));
    }

}