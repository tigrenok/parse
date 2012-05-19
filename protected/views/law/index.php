<?php
$this->breadcrumbs = array(
    'Laws' => array('index'),
    'Manage',
);
?>

<h1>Правила</h1>
<?php echo CHtml::link('Добавить', array('law/create')); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'law-grid',
    'template' => '{summary} {pager} <br /> {items} {pager}',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'description',
        array(
            'name' => 'law_type_id',
            'type' => 'raw',
            'value' => '$data->lawtype->name',
            'filter' => CHtml::listData(LawType::model()->findAll(),'id','name'),          
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
