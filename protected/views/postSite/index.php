<?php
$this->breadcrumbs = array(
    'Post Sites',
);
?>

<h1>Сайты для постинга</h1>

<?php echo CHtml::link('Добавить', array('postSite/create')); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'post-site-grid',
    'template' => '{summary} {pager} <br /> {items} {pager}',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'name',
        'login',
        'pass',
        'site',
        'rpc_script',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
