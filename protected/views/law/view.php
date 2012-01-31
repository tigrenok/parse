<?php
$this->breadcrumbs = array(
    'Laws' => array('index'),
    "Просмотр правила",
);
?>

<h3>Просмотр правила для <?php echo $model->sites->url; ?></h3>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'type',
        'description',
        'list_law',
        'title_law',
        'date_law',
        'autor_law',
        'content_law',
        'img_law',
        array(
            'name' => 'Sites',
            'value' => ((!empty($model->sites->url)) ? $model->sites->url : '-'),
        ),
    ),
));
?>
