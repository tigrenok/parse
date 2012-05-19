<?php

class LawController extends Controller {

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
        $fealdsthis = array();
        foreach (LawField::model()->findAll('t.law_id = ' . $id) as $key => $value) {
            $fealdsthis[] = array('name' => (isset($value->lawfieldtype->name)) ? $value->lawfieldtype->name : '', 'value' => $value->fn);
        }
        $this->render('view', array(
            'model' => $this->loadModel($id), 'fealdsthis' => $fealdsthis
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Law;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $fealdsthis = array();
        $fealds = LawFieldType::model()->findAll('t.show = 1');

        if (isset($_POST['Law'])) {
            $model->attributes = $_POST['Law'];
            if ($model->save()) {
                foreach ($_POST['Law']['fields'] as $key => $value) {
                    $id = $model->id;
                    if (!empty($value)) {
                        if ($lawfield = LawField::model()->find('law_id=' . $id . ' and type = ' . $key)) {
                            $lawfield->type = $key;
                            $lawfield->law_id = $id;
                            $lawfield->fn = $value;
                            $lawfield->save(false);
                        } else {
                            $lawfield = new LawField();
                            $lawfield->type = $key;
                            $lawfield->law_id = $id;
                            $lawfield->fn = $value;
                            $lawfield->save(false);
                        }
                    }
                }

                $this->redirect(array('view', 'id' => $model->id,));
            }
        }

        $this->render('create', array(
            'model' => $model, 'fealds' => $fealds, 'fealdsthis' => $fealdsthis
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $fealds = LawFieldType::model()->findAll('t.show = 1');
        $fealdsthis = array();
        foreach (LawField::model()->findAll('t.law_id = ' . $id) as $key => $value) {
            $fealdsthis[$value->type] = $value->fn;
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Law'])) {
            $model->attributes = $_POST['Law'];
            foreach ($_POST['Law']['fields'] as $key => $value) {
                if ($lawfield = LawField::model()->find('law_id=' . $id . ' and type = ' . $key)) {
                    if (!empty($value)) {
                        $lawfield->type = $key;
                        $lawfield->law_id = $id;
                        $lawfield->fn = $value;
                        $lawfield->save(false);
                    } else
                        $lawfield->delete();
                } else {
                    if (!empty($value)) {
                        $lawfield = new LawField();
                        $lawfield->type = $key;
                        $lawfield->law_id = $id;
                        $lawfield->fn = $value;
                        $lawfield->save(false);
                    }
                }
            }
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }



        $this->render('update', array(
            'model' => $model, 'fealds' => $fealds, 'fealdsthis' => $fealdsthis,
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
            LawField::model()->deleteAll('law_id = ' . $id);
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
        $model = new Law('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Law']))
            $model->attributes = $_GET['Law'];

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
        $model = Law::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'law-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
