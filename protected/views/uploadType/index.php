<?php
$this->breadcrumbs = array(
    'Upload Types' => array('index'),
    'Manage',
);
?>

<h1>Типы файлов</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'upload-type-grid',
    'dataProvider' => $model->search(),
    'template' => '{summary} {pager} <br /> {items} {pager}',
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
