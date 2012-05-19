<?php
$this->breadcrumbs=array(
	'Site Pars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SitePars', 'url'=>array('index')),
	array('label'=>'Manage SitePars', 'url'=>array('admin')),
);
?>

<h1>Добавить</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>