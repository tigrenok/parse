<?php
$this->breadcrumbs = array(
    'Codings' => array('index'),
    'Index',
);
?>

<h1>Кодировка</h1>

<?php echo CHtml::link('Добавить', array('coding/create')); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'coding-grid',
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
