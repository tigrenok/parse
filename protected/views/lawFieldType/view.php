<?php
$this->breadcrumbs=array(
	'Law Field Types'=>array('index'),
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
        array(
            'name' => 'show',
            'type' => 'raw',
            'value' => ($model->show)?'yes':'no',
        ),
		'param',
	),
)); ?>
