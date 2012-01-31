<?php
$this->breadcrumbs=array(
	'Contents'=>array('index'),
	'Добавить статью',
);

$this->menu=array(
	array('label'=>'List Content', 'url'=>array('index')),
	array('label'=>'Manage Content', 'url'=>array('admin')),
);
?>

<h1>Добавить статью</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>