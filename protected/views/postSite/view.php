<?php
$this->breadcrumbs=array(
	'Post Sites'=>array('index'),
	$model->name,
);

?>

<h1>Просмотр</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'login',
		'pass',
		'site',
		'rpc_script',
	),
)); ?>
