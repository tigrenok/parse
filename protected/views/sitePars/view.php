<?php
$this->breadcrumbs = array(
    'Site Pars' => array('index'),
    $model->name,
);
?>

<h1>Просмотр</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array_merge(array(
        'id',
        'url',
        'name',
        array(
            'name' => 'coding_id',
            'type' => 'raw',
            'value' => $model->coding->name,
        ),
        array(
            'name' => 'law_id',
            'type' => 'raw',
            'value' => (!empty($model->law->description)) ? $model->law->description : '',
        ),
    ),$fealdsthis)
));
?>