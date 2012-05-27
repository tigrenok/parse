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
     * Точка входа на парсиг с id сайта
     * @param int $id 
     */
    public function actionParse($id) {
        $model = $this->loadModel($id);
        $parse = Parse::go($id);
        $this->render('parse', array(
            'model' => $model, 'parse' => $parse,
        ));
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

    public function actionLawInfo($id) {
        $model = SitePars::model()->findByPk($id);
        echo $this->renderPartial('/law/view', $model->lawInfo($model));
    }

    public function actionChildInfo($id) {  
        $model = SitePars::model()->findByPk($id);
        echo $this->renderPartial('/sitePars/view', $model->childInfo($model));
    }

}
