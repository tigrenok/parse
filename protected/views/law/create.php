<?php
$this->breadcrumbs=array(
	'Laws'=>array('index'),
	'Create',
);
?>

<h1>Добавить</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'fealds'=>$fealds, 'fealdsthis' => $fealdsthis)); ?>