<?php

/**
 * This is the model class for table "{{law_field}}".
 *
 * The followings are the available columns in table '{{law_field}}':
 * @property integer $id
 * @property integer $law_id
 * @property integer $type
 * @property string $fn
 */
class LawField extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return LawField the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{law_field}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('law_id, type', 'numerical', 'integerOnly' => true),
            array('fn', 'length', 'max' => 500),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, law_id, type, fn', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'lawfieldtype' => array(self::BELONGS_TO, 'LawFieldType', 'type'),
            'law' => array(self::BELONGS_TO, 'Law', 'law_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'law_id' => 'Law',
            'type' => 'Type',
            'fn' => 'Fn',
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
        $criteria->compare('law_id', $this->law_id);
        $criteria->compare('type', $this->type);
        $criteria->compare('fn', $this->fn, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['pageSize'],
                    ),
                ));
    }

}