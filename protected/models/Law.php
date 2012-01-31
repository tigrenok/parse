<?php

/**
 * This is the model class for table "{{law}}".
 *
 * The followings are the available columns in table '{{law}}':
 * @property integer $id
 * @property string $description
 * @property string $list_law
 * @property string $title_law
 * @property string $date_law
 * @property string $autor_law
 * @property string $content_law
 * @property string $img_law
 */
class Law extends CActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @return Law the static model class
   */
  public static function model($className=__CLASS__) {
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
        array('description, list_law', 'length', 'max' => 255),
        array('type', 'length', 'max' => 4),
        array('title_law, date_law, autor_law, content_law, img_law', 'length', 'max' => 500),
        array('description, title_law, content_law, img_law, type', 'required'),
        array('list_law','validdateLawList'),
        // The following rule is used by search(). 
        // Please remove those attributes that should not be searched.
        array('id, description, list_law, title_law, date_law, autor_law, content_law, img_law, type', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
        'sites' => array(self::HAS_ONE, 'Sites', 'law_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'description' => 'Description',
        'list_law' => 'List Law',
        'title_law' => 'Title Law',
        'date_law' => 'Date Law',
        'autor_law' => 'Autor Law',
        'content_law' => 'Content Law',
        'img_law' => 'Img Law',
        'type' => 'Type',
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
    $criteria->compare('list_law', $this->list_law, true);
    $criteria->compare('title_law', $this->title_law, true);
    $criteria->compare('date_law', $this->date_law, true);
    $criteria->compare('autor_law', $this->autor_law, true);
    $criteria->compare('content_law', $this->content_law, true);
    $criteria->compare('img_law', $this->img_law, true);
    $criteria->compare('type', $this->type, true);

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

   /**
   * Валидация списка
   * @param array $model->type
   * @return Bool
   *
   */
  public function validdateLawList($attributes = null, $clearErrors = true) {
    if ($this->type == 'list' and empty($this->list_law)) {
      $this->addError('list_law', 'Укажите правило парсинга списка ');
      return false;
    } else
      return true;
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