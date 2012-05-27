<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);
?>

<h3>Просмотр</h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'email',
	),
)); ?>
