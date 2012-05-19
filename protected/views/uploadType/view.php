<?php
$this->breadcrumbs = array(
    'Upload Types' => array('index'),
    $model->name,
);
?>

<h1>Просмотр</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'template' => '{summary} {pager} <br /> {items} and {pager}',
    'attributes' => array(
        'id',
        'name',
        'value',
    ),
));
?>
