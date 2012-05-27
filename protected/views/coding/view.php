<?php
$this->breadcrumbs=array(
	'Codings'=>array('index'),
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
