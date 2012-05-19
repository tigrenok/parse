<?php
$this->breadcrumbs=array(
	'Codings'=>array('index'),
	$model->name,
);
?>

<h1>Просмотр</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'value',
	),
)); ?>
