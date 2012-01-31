<?php

Yii::import('zii.widgets.CPortlet');
 
class UserMenuPars extends CPortlet
{
    public function init()
    {
        $this->title='Парсинг';
        parent::init();
    }
 
    protected function renderContent()
    {
        $this->render('userMenuPars');
    }
}
?>