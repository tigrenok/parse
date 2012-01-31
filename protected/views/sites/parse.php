<?php
$this->breadcrumbs=array(
	'Sites'=>array('index'),
	'Парсинг',
);
?>

<?php if(empty ($model->law->id)): ?>
<h1>Не задано правило для парсинга</h1>
<?php else: ?>
<h1>Идет парсинг <?php echo $model->url; ?></h1>
Готово!!!<br />
<?php echo CHtml::link('Перейти на статью', array('content/view/'.(int)$id)); ?>
<?php endif; ?>
