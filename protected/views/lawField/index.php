<?php
$this->breadcrumbs = array(
    'Law Fields' => array('index'),
    'Manage',
);
?>

<h1>Элементы правил</h1>

<?php echo CHtml::link('Добавить', array('lawField/create')); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'law-field-grid',
    'template' => '{summary} {pager} <br /> {items} {pager}',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'name' => 'law_id',
            'type' => 'raw',
            'value' => '(!empty($data->law->description))?$data->law->description:"";',
            'filter' => CHtml::listData(Law::model()->findAll(),'id','description'), 
        ),
        array(
            'name' => 'type',
            'type' => 'raw',
            'value' => '(!empty($data->lawfieldtype->name))?$data->lawfieldtype->name:"";',
            'filter' => CHtml::listData(LawFieldType::model()->findAll(),'id','name'), 
        ),
        'fn',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
