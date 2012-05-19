<?php
$this->breadcrumbs=array(
	'Contents'=>array('index'),
	'Create',
);
?>

<h1>Добавить</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>