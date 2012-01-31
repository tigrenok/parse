<?php
$this->breadcrumbs=array(
	'Sites'=>array('index'),
	'Добавить сайт',
);
?>

<h3>Добавить сайт</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model,'law'=>$law)); ?>