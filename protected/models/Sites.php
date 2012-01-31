<?php

/**
 * This is the model class for table "{{sites}}".
 *
 * The followings are the available columns in table '{{sites}}':
 * @property integer $id
 * @property string $url
 * @property string $name
 * @property string $type
 */
class Sites extends CActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @return Sites the static model class
   */
  public static function model($className=__CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{sites}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('url, name', 'length', 'max' => 255),
        array('id, url, name', 'safe', 'on' => 'search'),
        array('url, name, coding', 'required'), //,'Такой url уже есть в списке'),   
        array('law_id', 'numerical'),
        array('url', 'unique'), //,'Такой url уже есть в списке'),
        array('url', 'url'), //,'','Неправильный формат url'),
        array('id, url', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
        'law' => array(self::BELONGS_TO, 'Law', 'law_id'),
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
        'coding' => 'Coding',
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
    $criteria->compare('law_id', $this->law_id, true);
    $criteria->compare('coding', $this->coding, true);    

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

  public static function getcount() {
    $count = Yii::app()->db->createCommand()->select('count(*) as count')->from(self::model()->tableName())->queryRow();
    return $count['count'];
  }

}