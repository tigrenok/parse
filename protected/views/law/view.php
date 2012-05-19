<?php
$this->breadcrumbs=array(
	'Laws'=>array('index'),
	$model->id,
);
?>

<h1>Просмотр</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array_merge(array(
		'id',
		'description',
		'stop',
        array(
            'name' => 'law_type_id',
            'type' => 'raw',
            'value' => $model->lawtype->name,
        ),
        array(
            'name' => 'chil_id',
            'type' => 'raw',
            'value' => (!empty($model->chil->description))?$model->chil->description:'',
        ),
	),$fealdsthis )
)); ?>
