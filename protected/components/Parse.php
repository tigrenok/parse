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
                $parse = Parse::getCont($model, $type);
                break;
            case 'list_block':
                $parse = Parse::getCont($model, $type);
                break;
            case 'list_link':
                $list = Parse::getLawList($model);
                $result = array();
                if (!empty($list)) {
                    $child = $model->child;
                    $type = $child->law->lawtype->value;
                    foreach ($list as $key => $value)
                        $result[] = Parse::getCont($child, $type, $value);
                }
                $parse = self::getParseArray($result);
                break;

            case 'list_link_interval':
                $type = $model->child->law->lawtype->value;
                $list_interval = Parse::getLawListInterval($model);
                $parse = array();

                if (in_array($type, array('one', 'list_block'))) {
                    foreach ($list_interval as $key => $value) {
                        echo $value . "\n";
                        $model->child->url = $value;
                        $parse[] = key(Parse::getCont($model->child, $type));
                        sleep(3);
                    }
                }

                if (in_array($type, array('list_link'))) {
                    foreach ($list_interval as $key => $value) {
                        echo $value . "\n";
                        $model->child->url = $value;
                        $model_child = $model->child;

                        $list = Parse::getLawList($model_child);
                        $result = array();
                        if (!empty($list)) {
                            $child = $model_child->child;
                            $type = $child->law->lawtype->value;
                            foreach ($list as $key => $value)
                                $result[] = Parse::getCont($child, $type, $value);
                        }
                        sleep(3);
                    }
                    $parse = self::getParseArray($result);
                }

                $parse = array_flip($parse);
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
     * Возвращает список страниц в интервале которые входят в парсинг
     * @param object $model
     * @return array 
     */
    public static function getLawListInterval($model) {
        preg_match_all("|\[(.*)\]|U", $model->url, $rex, PREG_PATTERN_ORDER);
        $return = array(0 => $model->url);
        foreach ($rex[1] as $key => $value) {
            $interval = explode("-", $value);
            for ($i = (int) $interval[1]; $i <= $interval[2]; $i++) {
                foreach ($return as $k => $v) {
                    $tmp[] = str_replace("[" . $value . "]", $i, $v);
                }
            }
            $return = $tmp;
            $tmp = array();
        }
        return $return;
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
                    if ($model->coding->value != "UTF-8")
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
        $html = new simple_html_dom();

        foreach ($data['content'] as $key => $cont) {
            $serialize = array();
            $str_cont = '';
            foreach ($arr_seril as $value) {
                if ($value == 'content') {
                    if(is_string($cont)){
                        $html->load($cont);
                        foreach ($html->find('[onclick]') as $ok => $ov) 
                                $cont= str_replace($ov->onclick, "return true;", $cont);                        
                    }
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

    public static function getParseArray($result) {
        $parse = array();
        foreach ($result as $key => $value)
            if (is_array($value))
                foreach ($value as $k => $v)
                    $parse[$k] = $v;
        return $parse;
    }

}
