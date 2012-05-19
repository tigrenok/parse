<?php
$this->breadcrumbs = array(
    'Pars' => array('index'),
);
?>

<h1>Парсинг</h1>
<?php if ($parse): ?>
    Отпарсено <br />
    <a href='/content/index'>Просмотреть все </a><br />
    <?php foreach ($parse as $key => $value): ?>
        <?php echo CHtml::link($key, "/content/" . $key) ?><br />
    <?php endforeach; ?>
<?php else: ?>
    Нет новых статей на <?php echo $model->url; ?>
<?php endif; ?>
