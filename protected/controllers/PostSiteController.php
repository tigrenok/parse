<?php

class PostSiteController extends Controller {

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
    $this->render('view', array(
        'model' => $this->loadModel($id),
    ));
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate() {
    $model = new PostSite;

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['PostSite'])) {
      $model->attributes = $_POST['PostSite'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
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

    if (isset($_POST['PostSite'])) {
      $model->attributes = $_POST['PostSite'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
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
    $model = new PostSite('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['PostSite']))
      $model->attributes = $_GET['PostSite'];

    $this->render('index', array(
        'model' => $model,
    ));
  }

  public function actionPost() {


    if (isset($_POST['content_id']) and isset($_POST['post_site_id'])) {
      $data = array();
      $data['config'] = PostSite::model()->findByPk((int) $_POST['post_site_id']);

      foreach (Content::model()->findByPk((int) $_POST['content_id']) as $key => $value) {
        if ($key == 'data')
          foreach (unserialize($value) as $k => $v)
            $data['content'][$k] = $v;
        else
          $data['content'][$key] = $value;
      }

      $data['params'] = $_POST;
      $model = PostComponent::go($data);
    } else {
      $model = null;
    }

    $this->render('post', array(
        'model' => $model,
    ));
  }

  public function actionSiteList($id) {
    $return = array();
    foreach (PostSiteCategories::model()->findAll('t.site_id=' . $id) as $key => $value) {
      $return[$value->id] = $value->name;
    }
    if (!empty($return))
      echo CHtml::dropDownList('post_site_categories', 0, $return);
    else
      echo CHtml::dropDownList('post_site_categories', 0, array(0 => "Выбрать"), array('disabled' => 'disabled'));
  }

  public function actionSiteInfo($id) {
    if (!empty($id)) {
      $model = PostSite::model()->findByPk($id);
      echo $this->renderPartial('/postSite/_view', array('data' => $model));
    } else {
      echo 'Не правильный id или нет такой записи!';
    }
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id) {
    $model = PostSite::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'post-site-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

}
