<?php
$this->breadcrumbs=array(
	'Laws'=>array('index'),
	'Добавить правило',
);
?>

<h3>Добавить правило</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>