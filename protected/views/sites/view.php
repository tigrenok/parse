<?php
$this->breadcrumbs = array(
    'Sites' => array('index'),
    'Просмотр',
);
?>

<h3>Просмотр <?php echo $model->url; ?></h3>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'url',
        'name',
        'coding',
        array(
            'name' => 'Law',
            'value' => ((!empty($model->law->description)) ? $model->law->description : '-'),
        ),
    ),
));
?>
