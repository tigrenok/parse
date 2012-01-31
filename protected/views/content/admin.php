<?php
$this->breadcrumbs = array(
    'Contents' => array('index'),
    'Статьи',
);

$this->menu = array(
    array('label' => 'List Content', 'url' => array('index')),
    array('label' => 'Create Content', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('content-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Статьи</h1>

<?php echo CHtml::link('Добавить статью', '/content/create'); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'content-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'title',
        //'content',
        'date_public',
        //'type',
        'parse_site',
        'date_parse',
        //'autor',
        array(
            'header' => 'Public',
            'type' => 'raw',
            'value' => 'CHtml::link("Public","/content/public/".$data->id)',
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>

  <?php echo CHtml::link('Расширенный поиск', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
  <?php
  $this->renderPartial('_search', array(
      'model' => $model,
  ));
  ?>
</div><!-- search-form -->