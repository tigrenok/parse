<?php
$this->breadcrumbs=array(
	'Post Site Categories'=>array('index'),
	'Create',
);
?>

<h1>Добавить</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>