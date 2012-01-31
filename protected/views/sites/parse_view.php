<?php
$this->breadcrumbs=array(
	'Sites'=>array('index'),
	'Парсинг',
);
?>

<?php if(empty ($model->law->id)): ?>
<h1>Не задано правило для парсинга</h1>
<?php else: ?>
<h1>Парсить <?php echo $model->url; ?></h1>
  <?php 
  if($model->law->type=='one')
    echo $this->renderPartial('_one', array('model'=>$model->law)); 
  else 
    echo $this->renderPartial('_list', array('model'=>$model->law)); 
  ?>
<?php endif; ?>
