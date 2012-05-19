<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);
?>

<h1>Пользователи</h1>

<?php echo CHtml::link('Добавить',array('user/create')); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		'email',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
