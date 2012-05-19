<?php

class AuthFilter extends CFilter
{
    protected function preFilter($filterChain)
    {
        if(Yii::app()->user->isGuest){
           $cn = new Controller('1');
           $cn->redirect(Yii::app()->user->loginUrl);
        }
        return true;
    }
 
}
?>
