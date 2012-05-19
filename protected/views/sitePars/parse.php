<?php
$this->breadcrumbs = array(
    'Pars' => array('index'),
);
?>

<h1>Парсинг</h1>
<?php if($parse):?>
Внимание идет парсин сайта <?php echo $model->url;?>
<?php else:?>
Не удалось отпарсить сайт <?php echo $model->url;?>
<?php endif; ?>
