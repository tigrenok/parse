<?php

class Comp extends CComponent {

    public static function getcount($table) {
        $count = Yii::app()->db->createCommand()->select('count(*) as count')->from("{{" . $table . "}}")->queryRow();
        return $count['count'];
    }

    public static function getlistv($table, $key, $value) {
        $model = new $table;
        return array_merge(array('0' => 'Выбрать'), CHtml::listData($model::model()->findAll(), $key, $value));
    }

    public static function getlist($table, $key, $value) {
        $model = new $table;
        return CHtml::listData($model::model()->findAll(), $key, $value);
    }

    public static function microtime_float() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float) $usec + (float) $sec);
    }

}

?>
