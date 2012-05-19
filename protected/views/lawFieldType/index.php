<?php
$this->breadcrumbs = array(
    'Law Field Types' => array('index'),
    'Manage',
);
?>

<h1>Типы элементов правил</h1>
<?php echo CHtml::link('Добавить', array('lawFieldType/create')); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'law-field-type-grid',
    'template' => '{summary} {pager} <br /> {items}  {pager}',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'name',
        'value',
        array(
            'name' => 'show',
            'type' => 'raw',
            'value' => '($data->show)?"yes":"no"',
        ),
        'param',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
