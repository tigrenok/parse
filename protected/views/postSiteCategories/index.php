<?php
$this->breadcrumbs = array(
    'Post Site Categories',
);

$this->menu = array(
    array('label' => 'Create PostSiteCategories', 'url' => array('create')),
    array('label' => 'Manage PostSiteCategories', 'url' => array('admin')),
);
?>

<h1>Категории сайтов на постинг</h1>
<?php echo CHtml::link('Добавить', array('postSiteCategories/create')); ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'post-site-categories-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'name',
        'value',
        array(
            'name' => 'site_id',
            'type' => 'raw',
            'value' => '(!empty($data->post_site->name))?$data->post_site->name:"";',
            'filter' => CHtml::listData(PostSite::model()->findAll(), 'id', 'name'),
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
