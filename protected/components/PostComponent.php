<?php

class PostComponent extends CApplicationComponent {

    /**
     * Стартова функция
     * @param type $data
     * @return type 
     */
    public static function go($data) {
        Yii::import('application.vendors.*');
        require_once ('IXR_Library.php');
        
        
        
        return $data;
    }

}
