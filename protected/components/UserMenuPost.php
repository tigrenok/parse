<?php

Yii::import('zii.widgets.CPortlet');
 
class UserMenuPost extends CPortlet
{
    public function init()
    {
        $this->title='Постинг';
        parent::init();
    }
 
    protected function renderContent()
    {
        $this->render('userMenuPost');
    }
}
?>