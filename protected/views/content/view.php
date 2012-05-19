<?php
$this->breadcrumbs = array(
    'Contents' => array('index'),
    $model->id,
);
?>

<h1>View Content #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array_merge(array(
        'id',
        'stop',
        'date_public',
        'date_parse',
        array(
            'name' => 'site_id',
            'type' => 'raw',
            'value' => (!empty($model->site->url)) ? $model->site->url : '',
        ),
            ), $data),
));
?>
