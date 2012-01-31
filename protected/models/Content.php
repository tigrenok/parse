<?php

/**
 * This is the model class for table "{{content}}".
 *
 * The followings are the available columns in table '{{content}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $date_public
 * @property string $type
 * @property string $parse_site
 * @property string $date_parse
 * @property string $autor
 */
class Content extends CActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @return Content the static model class
   */
  public static function model($className=__CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{content}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('type, parse_site, date_parse, autor', 'length', 'max' => 255),
        array('title, content, date_public', 'safe'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, title, content, date_public, type, parse_site, date_parse, autor', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'title' => 'Title',
        'content' => 'Content',
        'date_public' => 'Date Public',
        'type' => 'Type',
        'parse_site' => 'Parse Site',
        'date_parse' => 'Date Parse',
        'autor' => 'Autor',
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
    $criteria->compare('title', $this->title, true);
    $criteria->compare('content', $this->content, true);
    $criteria->compare('date_public', $this->date_public, true);
    $criteria->compare('type', $this->type, true);
    $criteria->compare('parse_site', $this->parse_site, true);
    $criteria->compare('date_parse', $this->date_parse, true);
    $criteria->compare('autor', $this->autor, true);

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

  /**
   * Возвращает количество записей
   * @return type 
   */
  public static function getcount() {
    $count = Yii::app()->db->createCommand()->select('count(*) as count')->from(self::model()->tableName())->queryRow();
    return $count['count'];
  }

}