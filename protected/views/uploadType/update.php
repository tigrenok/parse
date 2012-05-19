<?php
$this->breadcrumbs=array(
	'Upload Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Редактировать></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>