<?php
$this->breadcrumbs=array(
	'Law Types'=>array('index'),
	'Create',
);
?>

<h1>Добавить</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>