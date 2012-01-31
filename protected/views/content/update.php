<?php
$this->breadcrumbs=array(
	'Contents'=>array('index'),
	'Редактировать статью',
);

?>

<h1>Редактировать статью № <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>