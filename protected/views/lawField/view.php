<?php
$this->breadcrumbs = array(
    'Law Fields' => array('index'),
    $model->id,
);
?>

<h1>Просмотр</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        array(
            'name' => 'law_id',
            'type' => 'raw',
            'value' => (!empty($model->law->description)) ? $model->law->description : '',
        ),
        array(
            'name' => 'type',
            'type' => 'raw',
            'value' => $model->lawfieldtype->name,
        ),
        'fn',
    ),
));
?>
