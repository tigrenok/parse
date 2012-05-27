<?php
$this->breadcrumbs=array(
	'Law Types'=>array('index'),
	$model->name,
);
?>

<h3>Просмотр</h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'value',
	),
)); ?>
