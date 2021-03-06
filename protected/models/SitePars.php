<?php

/**
 * This is the model class for table "{{site_pars}}".
 *
 * The followings are the available columns in table '{{site_pars}}':
 * @property integer $id
 * @property string $url
 * @property string $name
 * @property integer $law_id
 * @property integer $coding_id
 */
class SitePars extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SitePars the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{site_pars}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('law_id, coding_id,child_id', 'numerical', 'integerOnly' => true),
            array('url, name', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, url, name, law_id, coding_id,child_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'coding' => array(self::BELONGS_TO, 'Coding', 'coding_id'),
            'law' => array(self::BELONGS_TO, 'Law', 'law_id'),
            'child' => array(self::BELONGS_TO, 'SitePars', 'child_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'url' => 'Url',
            'name' => 'Name',
            'law_id' => 'Law',
            'coding_id' => 'Coding',
            'child_id' => 'Child',
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
        $criteria->compare('url', $this->url, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('law_id', $this->law_id);
        $criteria->compare('coding_id', $this->coding_id);
        $criteria->compare('child_id', $this->child_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['pageSize'],
                    ),
                ));
    }

    public static function lawInfo($model) {
        $fealdsthis = array();
        foreach (LawField::model()->findAll('t.law_id = ' . $model->law->id) as $key => $value) {
            $fealdsthis[] = array('name' => (isset($value->lawfieldtype->name)) ? $value->lawfieldtype->name : '', 'value' => $value->fn);
        }
        return array('model' => $model->law, 'fealdsthis' => $fealdsthis);
    }

    public static function childInfo($model) {
        $child = SitePars::model()->findByPk($model->id);
        $fealdsthis = array();
        if (!empty($child->law->id))
            foreach (LawField::model()->findAll('t.law_id = ' . $child->law->id) as $key => $value) {
                $fealdsthis[] = array('name' => $value->lawfieldtype->name, 'value' => $value->fn);
            }
        return array('model' => $child, 'fealdsthis' => $fealdsthis);
    }

}