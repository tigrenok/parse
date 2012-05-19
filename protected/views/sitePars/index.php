<?php
$this->breadcrumbs = array(
    'Site Pars' => array('index'),
    'Manage',
);
?>

<h1>Сайты на парсинг</h1>

<?php echo CHtml::link('Добавить', array('sitePars/create')); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'site-pars-grid',
    'dataProvider' => $model->search(),
    'template' => '{summary} {pager} <br /> {items} {pager}',
    'filter' => $model,
    'columns' => array(
        'id',
        'url',
        'name',
        array(
            'name' => 'law_id',
            'type' => 'raw',
            'value' => '(!empty($data->law->description))?$data->law->description:"";',
        ),
        array(
            'name' => 'coding_id',
            'type' => 'raw',
            'value' => '$data->coding->name',
            'filter' => CHtml::listData(Coding::model()->findAll(),'id','name'), 
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::imageButton("/images/parse.jpg",array("submit"=>"/sitePars/parse/$data->id","width"=>"20px","title"=>"Парсить"))',
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
