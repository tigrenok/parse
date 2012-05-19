<?php
$this->breadcrumbs=array(
	'Site Pars'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Редактировать</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>