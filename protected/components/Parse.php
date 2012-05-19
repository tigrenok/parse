<?php

/**
 * Image handler
 * @author Pelesh Yaroslav aka Tokolist (http://tokolist.com)
 * @version 0.9 beta
 */
class Parse extends CApplicationComponent {

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public static function go($id) {
        Yii::import('zii.widgets.CPortlet');
        $model = self::loadModel($id);
        $parse = false;
        $type = $model->law->lawtype->value;

        switch ($type) {
            case 'one':
                // echo "\t type = \t".$type."\n";
                $parse = Parse::getCont($model, $type);
                break;
            case 'list_block':
                //  echo "\t type = \t".$type."\n";
                $parse = Parse::getCont($model, $type);
                break;
            case 'list_link':
                // echo "\t type = \t".$type."\n";
                $list = Parse::getLawList($model);
                $result = array();
                if (!empty($list)) {
                    $child = $model->child;
                    $type = $child->law->lawtype->value;
                    foreach ($list as $key => $value) 
                        $result[] = Parse::getCont($child, $type, $value);                    
                }
                foreach ($result as $key => $value) 
                    if(is_array($value))
                        foreach ($value as $k=>$v)
                            $parse[$k]=$v;                
                break;
        }

        return $parse;
    }

    public static function loadModel($id) {
        $model = SitePars::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Возврашает правила парсинга 
     * @return type 
     */
    public static function getLawList($model) {
        $arr = array();
        $html = new simple_html_dom();
        $html->load_file($model->url);
        foreach (LawField::model()->findAll('t.law_id = ' . $model->law->id) as $k => $v) {
            if ($v->lawfieldtype->param == 1) {
                foreach ($html->find($v->fn) as $element) {
                    $arr[] = self::getUrl($element->href, $model->url);
                }
            }
        }
        return $arr;
    }

    /**
     * Основной блок парсинга
     * @param object $model
     * @param string $type
     * @return array 
     */
    public static function getCont($model, $type, $new_url = false) {

        $stopthis = false;
        if ($stopcontent = Content::model()->find('t.site_id=' . $model->id . " order by date_parse_time")) {
            $stopthis = $stopcontent->stop;
        }

        $html = new simple_html_dom();
        if ($new_url)
            $html->load_file($new_url);
        else
            $html->load_file($model->url);

        $data = array();
        $img = false;
        if ($imgparse = LawField::model()->find('t.law_id = ' . $model->law->id . ' and t.type=6'))
            $img = $imgparse->fn;

        $video = false;
        if ($videoparse = LawField::model()->find('t.law_id = ' . $model->law->id . ' and t.type=7'))
            $video = $videoparse->fn;

        $audio = false;
        if ($audioparse = LawField::model()->find('t.law_id = ' . $model->law->id . ' and t.type=8'))
            $audio = $audioparse->fn;


        foreach (LawField::model()->findAll('t.law_id = ' . $model->law->id) as $k => $v) {
            if ($v->lawfieldtype->param == 1) {
                $data[$v->lawfieldtype->value] = '';
                $stop = $model->law->stop;

                foreach ($html->find($v->fn) as $element) {

                    if ($v->lawfieldtype->value == 'content') {
                        $stop = $model->law->stop;
                        $data[$v->lawfieldtype->value]['stop'][] = $element->$stop;
                    }
                    $content = $element->innertext;
                    if ($stopthis and $element->$stop == $stopthis) {
                        break;
                    }

                    if ($img)
                        eval("\$content= " . $img . ";");
                    if ($video)
                        eval("\$content= " . $video . ";");
                    if ($audio)
                        eval("\$content= " . $audio . ";");
                    if($model->coding->value != "UTF-8")
                    $data[$v->lawfieldtype->value][] = iconv($model->coding->value, "UTF-8", $content);
                    else
                    $data[$v->lawfieldtype->value][] = $content;
                }
            }
        }
        
        foreach (LawFieldType::model()->findAll('t.param=1') as $value) {
            $arr_seril[] = $value->value;
        }

        $return = array();

        foreach ($data['content'] as $key => $cont) {
            $serialize = array();
            $str_cont = '';
            foreach ($arr_seril as $value) {
                if ($value == 'content') {
                    $serialize['content'] = $cont;
                    $str_cont = $serialize[$value];
                } else
                    $serialize[$value] = (isset($data[$value][0])) ? trim($data[$value][0]) : '';
            }
            if (!is_array($str_cont)) {
                $content = new Content();
                $content->data = serialize($serialize);
                $content->date_parse = date('Y.m.d H:i:s');
                $content->date_parse_time = Comp::microtime_float();
                if ($type == 'list_block')
                    $content->stop = array_shift($data['content']['stop']);
                $content->site_id = $model->id;
                $content->save(false);
                $return[$content->id] = !empty($cont['header']) ? $cont['header'] : 'content';
            }
        }
        return $return;
    }

    /**
     * Сохраниет картики
     * @param string $content
     * @param string $src
     * @return boolean 
     */
    public static function getContentImg($content, $src) {
        if ($file_img = file_get_contents($src)) {
            $file_name = md5(rand(0, 10000000)) . strrchr($src, ".");
            $openedfile = fopen(Yii::app()->params['upload_dir_save'] . '/' . $file_name, "w");
            fwrite($openedfile, $file_img);
            fclose($openedfile);
            return str_replace($src, Yii::app()->params['upload_server'] . "/" . Yii::app()->params['upload_dir'] . '/' . $file_name, $content);
        } else {
            return false;
        }
    }

    /**
     * возврашает контет с  картинками
     * @param string $content
     * @param string $pref
     * @return string 
     */
    public static function imgcontent($content, $pref = '') {
        $imgfind = str_get_html($content);
        foreach ($imgfind->find('img') as $img) {
            $src = (!empty($pref)) ? self::getUrl($img->src, $pref) : $img->src;
            $content = self::getContentImg($content, $src);
        }
        return $content;
    }

    /**
     * возвращает ссылки видео контент
     * @param string $content
     * @param string $src
     * @param string $link
     * @return string 
     */
    public static function videocontent($content, $src, $link = '') {
        $videofind = str_get_html($content);
        $return = array();
        foreach ($videofind->find($src) as $video) {
            $content = str_replace($video->href, $link . $video->href, $content);
        }
        return $content;
    }

    /**
     * возвращает ссылки аудио контент
     * @param string $content
     * @param string $src
     * @param string $link
     * @return string 
     */
    public static function audiocontent($content, $src, $link = '') {
        $audiofind = str_get_html($content);
        $return = array();
        foreach ($audiofind->find($src) as $audio) {
            $content = str_replace($link, "", $content);
            $content = str_replace($audio->href, $link . $audio->href, $content);
        }
        return $content;
    }

    /**
     * Возвращает абсолютный url
     * @param string $url
     * @param string $pref
     * @return string 
     */
    public static function getUrl($url, $pref) {
        if (preg_match("/^[http|www\.]+[A-z0-9\_\-\:\/\.]+$/", $url)) {
            return $url . "\n";
        } else {
            if (preg_match("/^[\/]+[A-z0-9\_\-\:\/\.]+$/", $url))
                return $pref . $url . "\n";
            else
                return $pref . "/" . $url . "\n";
        }
    }
}
