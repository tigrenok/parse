<?php

class ParseCommand extends CConsoleCommand {

    public $start;

    public function actionIndex($id = null) {
        $this->start = microtime(true);
        if ($id) {
            $parse = Parse::go($id);
            foreach ($parse as $key => $value) {
                //echo "\tid=\t".var_dump($value)."\n";
                echo "\tid=\t".$key."\n";
            }
            echo "\n" . $this->microtime_float($this->start);
        } else {
            echo "./yiic parse --id=\$id \n";
        }
    }

    public function actionHelp() {
        foreach (CHtml::listData(SitePars::model()->findAll(), 'id', 'name') as $key => $value) {
            echo "\tid = " . $key . "\t site = " . $value . "\n";
        }
    }

    public function microtime_float($start) {
        $end = microtime(true);
        $time = (float) ($end - $start);
        return date("i:s",$time)."\n";
    }

}

