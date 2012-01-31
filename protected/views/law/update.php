<?php
$this->breadcrumbs=array(
	'Laws'=>array('index'),
	'Редактировать',
);
?>

<h3>Редактировать правило для <?php echo $model->sites->url; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>