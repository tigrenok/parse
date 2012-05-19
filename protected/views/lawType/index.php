<?php
$this->breadcrumbs = array(
    'Law Types' => array('index'),
    'Manage',
);
?>

<h1>Типы правил</h1>
<?php echo CHtml::link('Добавить', array('lawType/create')); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'law-type-grid',
    'template' => '{summary} {pager} <br /> {items} {pager}',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'name',
        'value',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
