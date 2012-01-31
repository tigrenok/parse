<?php
$this->breadcrumbs = array(
    'Laws' => array('index'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('law-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('Добавить правило', '/law/create'); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'law-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'header' => 'Site',
            'name' => 'sites',
            'type' => 'raw',
            'value' => '((!empty($data->sites->url))?$data->sites->url:"-")',
        ),
        'type',
        'description',
        /* 'list_law',
          'title_law',
          'date_law',
          'autor_law',
          'content_law',
          'img_law',
         */


        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
  <?php
  $this->renderPartial('_search', array(
      'model' => $model,
  ));
  ?>
</div><!-- search-form -->
