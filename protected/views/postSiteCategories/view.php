<?php
$this->breadcrumbs = array(
    'Post Site Categories' => array('index'),
    $model->name,
);
?>

<h1>Просмотр</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'value',
        array(
            'name' => 'Site_id',
            'type' => 'raw',
            'value' => (!empty($model->post_site->name)) ? $model->post_site->name : '',
        ),
    ),
));
?>
