<?php
$this->breadcrumbs=array(
	'Sites'=>array('index'),
	'Редактировать',
);
?>

<h1>Редактировать <?php echo $model->url; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'law'=>$law)); ?>