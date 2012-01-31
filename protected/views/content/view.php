<?php
$this->breadcrumbs = array(
    'Contents' => array('index'),
    "Статья № " . $model->id,
);
?>

<h1>Статья № <?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'title',
        array(
            'name' => 'content',
            'type'=>'raw',
            'value' => $model->content,
        ),
        'date_public',
        'type',
        'parse_site',
        'date_parse',
        'autor',
    ),
));
?>
