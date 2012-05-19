<?php
$this->breadcrumbs=array(
	'Codings'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Редактирование</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>