<?php

/**
 * This is the model class for table "{{content}}".
 *
 * The followings are the available columns in table '{{content}}':
 * @property integer $id
 * @property string $data
 * @property string $date_public
 * @property string $date_parse
 * @property integer $site_id
 */
class Content extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Content the static model class
     */
    public static function model($className = __CLASS__) {
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
            array('site_id', 'numerical', 'integerOnly' => true),
            array('data, date_public, date_parse', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, data, date_public, date_parse, site_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'site' => array(self::BELONGS_TO, 'SitePars', 'site_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'data' => 'Data',
            'date_public' => 'Date Public',
            'date_parse' => 'Date Parse',
            'stop' => 'Stop',
            'site_id' => 'Site',
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
        $criteria->compare('data', $this->data, true);
        $criteria->compare('date_public', $this->date_public, true);
        $criteria->compare('date_parse', $this->date_parse, true);
        $criteria->compare('site_id', $this->site_id);
        
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['pageSize'],
                    ),
                ));
    }

    public function getcontent() {
        $return = unserialize($this->data);
        return $return['content'];
    }

}