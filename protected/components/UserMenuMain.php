<?php

Yii::import('zii.widgets.CPortlet');
 
class UserMenuMain extends CPortlet
{
    public function init()
    {
        $this->title='Настройки';
        parent::init();
    }
 
    protected function renderContent()
    {
        $this->render('userMenuMain');
    }
}
?>