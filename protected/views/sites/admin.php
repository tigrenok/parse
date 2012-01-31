<?php
$this->breadcrumbs = array(
    'Sites' => array('index'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('sites-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('Добавить сайт', '/sites/create'); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'sites-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'header' => 'Url',
            'name' => 'url',
            'type' => 'raw',
            'value' => 'CHtml::link($data->url,$data->url)',
        ),
        'name',
        array(
            'header' => 'Law',
            'name' => 'law',
            'type' => 'raw',
            'value' => '((!empty($data->law->description))?$data->law->description:"-")',
        ),
        'coding',
        array(
            'header' => 'Parse',
            'type' => 'raw',
            'value' => '((!empty($data->law->description))?CHtml::link("Parse","/sites/parse/".$data->id):"")',
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