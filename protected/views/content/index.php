<?php
$this->breadcrumbs = array(
    'Contents' => array('index'),
    'Manage',
);
?>

<h1>Статьи</h1>
<?php echo CHtml::link('Добавить', array('content/create')); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'content-grid',
    'dataProvider' => $model->search(),
    'template'=>'{summary} {pager} <br /> {items} {pager}',
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'name' => 'site_id',
            'type' => 'raw',
            'value' => '(!empty($data->site->name))?$data->site->name:"";',
            'filter' => CHtml::listData(SitePars::model()->findAll(),'id','name'), 
        ),
        array(            
            'name' => 'data',
            'type' => 'raw',
            'value' => '$data->getcontent()', //
        ),
        'stop',
        'date_parse',
        'date_public',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>