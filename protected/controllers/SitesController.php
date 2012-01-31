<?php

class SitesController extends Controller {

  /**
   * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
   * using two-column layout. See 'protected/views/layouts/column2.php'.
   */
  public $layout = '//layouts/column2';

  /**
   * This is the action to handle external exceptions.
   */
  public function actionError() {
    if ($error = Yii::app()->errorHandler->error) {
      if (Yii::app()->request->isAjaxRequest)
        echo $error['message'];
      else
        $this->render('error', $error);
    }
  }
  /**
   * Displays a particular model.
   * @param integer $id the ID of the model to be displayed
   */
  public function actionView($id) {
    $this->render('view', array(
        'model' => $this->loadModel($id),
    ));
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate() {
    $model = new Sites;

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['Sites'])) {
      $model->attributes = $_POST['Sites'];
      if ($model->save())
        $this->redirect(array('index'));
    }

    $this->render('create', array(
        'model' => $model, 'law' => self::getLawList(),
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

    if (isset($_POST['Sites'])) {
      $model->attributes = $_POST['Sites'];
      // var_dump($_POST['Sites']);exit;
      if ($model->save())
        $this->redirect('/sites');
    }

    $this->render('update', array(
        'model' => $model, 'law' => self::getLawList(),
    ));
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionParse($id) {
    $model = $this->loadModel($id);

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['Parse']) and !empty($model->law->id)) {

      if ($model->law->type == 'one')
        $id = self::getOneData($model);
      else
        $id = '';

      $this->render('parse', array(
          'model' => $model, 'id' => $id,
      ));
    } else {
      $this->render('parse_view', array(
          'model' => $model,
      ));
    }
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
    $model = new Sites('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['Sites']))
      $model->attributes = $_GET['Sites'];

    $this->render('admin', array(
        'model' => $model,
    ));
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id) {
    $model = Sites::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'sites-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

  public static function getLawList() {
    $law = array(0 => 'Пока не задано');
    foreach (Law::model()->findAll() as $key => $value)
      $law[$value->id] = $value->description;
    return $law;
  }

  /**
   *
   * @param type $model
   * @return int 
   */
  public static function getOneData($model) {
    $html = new simple_html_dom();
    $html->load_file($model->url);

    $data = array();

    foreach ($model->law->attributes as $k => $v) {
      if (!in_array($k, array('id', 'type', 'description', 'img_law')) and $v != '')
        foreach ($html->find($v) as $element)
          $data[$k] .= iconv($model->coding, "UTF-8", $element->innertext);
      if ($k == 'img_law')
        foreach ($html->find($v) as $element)
          $data['content_law'] = self::getContentImg($data['content_law'], $element->src);
    }
    $content = new Content();
    $content->title = $data['title_law'];
    $content->content = $data['content_law'];
    $content->date_parse = date('d.m.Y H:i:s');
    $content->type = $model->law->type;
    $content->parse_site = $model->url;
    $content->autor = $data['autor_law'];
    $content->save(false);
    return $content->id;
  }

  public static function getContentImg($content, $src) {
    $file_img = file_get_contents($src);
    $file_name = md5(rand(0, 10000000)) . strrchr($src, ".");
    $openedfile = fopen(Yii::app()->params['upload_dir'] . '/' . $file_name, "w");
    fwrite($openedfile, $file_img);
    fclose($openedfile);
    return str_replace($src, Yii::app()->params['upload_server']."/" . Yii::app()->params['upload_dir'] . '/' . $file_name, $content);
  }

}
