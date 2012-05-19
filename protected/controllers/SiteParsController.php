<?php

class SiteParsController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        $fealdsthis = array();
        if (!empty($model->law->id))
            foreach (LawField::model()->findAll('t.law_id = ' . $model->law->id) as $key => $value) {
                $fealdsthis[] = array('name' => $value->lawfieldtype->name, 'value' => $value->fn);
            }
        $this->render('view', array(
            'model' => $model, 'fealdsthis' => $fealdsthis,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new SitePars;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SitePars'])) {
            $model->attributes = $_POST['SitePars'];
            if ($model->save())
                $this->redirect(array('index', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SitePars'])) {
            $model->attributes = $_POST['SitePars'];
            if ($model->save())
                $this->redirect(array('index', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new SitePars('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SitePars']))
            $model->attributes = $_GET['SitePars'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = SitePars::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    /**
     *Точка входа на парсиг с id сайта
     * @param int $id 
     */

    public function actionParse($id) {

        $model = $this->loadModel($id);

        $parse = false;
        eval("\$parse = self::getCont" . '($model,"' . $model->law->lawtype->value . '");');

        $this->render('parse', array(
            'model' => $model, 'parse' => $parse,
        ));
    }
/**
 *Возврашает правила парсинга 
 * @return type 
 */
    public static function getLawList() {
        $law = array(0 => 'Пока не задано');
        foreach (Law::model()->findAll() as $key => $value)
            $law[$value->id] = $value->description;
        return $law;
    }
/**
 *Основной блок парсинга
 * @param object $model
 * @param string $type
 * @return array 
 */
    public static function getCont($model, $type) {

        $stopthis = false;
        if ($stopcontent = Content::model()->find('t.site_id=' . $model->id . " order by date_parse_time")) {
            $stopthis = $stopcontent->stop;
        }

        $html = new simple_html_dom();
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
                    $data[$v->lawfieldtype->value][] = iconv($model->coding->value, "UTF-8", $content);
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
                $return[$content->id] = !empty($cont['header'])?$cont['header']:'content';
                
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
            $openedfile = fopen(Yii::app()->params['upload_dir'] . '/' . $file_name, "w");
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

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'site-pars-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
