<?php

class ParseCommand extends CConsoleCommand {

    public function actionIndex($id = null) {
        if($id){
        echo "YES   ".$id."\n";
        } else {
          echo "./yiic parse --id=\$id \n";  
        }
    }
    
    public function actionHelp(){
        foreach (CHtml::listData(SitePars::model()->findAll(), 'id', 'name') as $key => $value) {
            echo "\tid = ".$key."\t site = ".$value."\n";
            
        }
        
    }

}

